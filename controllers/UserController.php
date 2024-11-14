<?php

include_once 'models/User.php';
include_once 'models/Activity.php';
include_once 'models/Unit.php';
include_once 'models/ReservedUnit.php';
include_once 'config/Database.php'; // Include the database connection class

class UserController {
    private $user;
    private $unit;
    private $res_unit;
    private $activity;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->user = new User($db);

        $this->unit = new Unit($db);
        $this->res_unit = new ReservedUnit($db);
        $this->activity = new Activity($db);
    }

    public function createUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat_password'];
            $activity = 'Register';

            if($password == $repeat_password){
                $this->user->first_name = $_POST['first_name'];
                $this->user->last_name = $_POST['last_name'];
                $this->user->email_address = $_POST['email_address'];
                $this->user->contact_number = $_POST['contact_number'];
                $this->user->address = $_POST['address'];
                $this->user->password = $_POST['password'];

                if ($this->user->createUser()) {
                    echo "User registered successfully!";
                    $this->activity->addActivity($_POST['first_name'] . ' ' . $_POST['last_name'], $activity);
                } else {
                    echo "Error: Could not create user.";
                }
            } else {
                echo "<script>
                    alert('Error: Passwords do not match.');
                    window.location.href = '/RGarage/user/signup';
                </script>";
                exit();
            }

        }
    }

    public function authLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email_address = $_POST['email'];
            $this->user->password = $_POST['password'];
            $activity = 'Login';
            $authResult = $this->user->authUser();
    
            if ($authResult['status']) { 
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = [
                    'user_id' => $authResult['user']['id'],
                    'first_name' => $authResult['user']['first_name'],
                    'last_name' => $authResult['user']['last_name'],
                    'email_address' => $authResult['user']['email_address'],
                    'address' => $authResult['user']['address'],
                    'contact_number' => $authResult['user']['contact_number']
                ];
                $this->activity->addActivity($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'], $activity);
                echo "<script>
                    alert('Success: You\'re now logged in.');
                    window.location.href = '/RGarage'; // Redirect to dashboard or homepage
                </script>";
            } else {
                echo "<script>
                    alert('Error: " . $authResult['message'] . "');
                    window.location.href = '/RGarage/user/auth/login'; // Redirect back to login page
                </script>";
            }
        }
    }
    
    public function fetchUnits(){
        try {
            // Fetch all units using the Unit model
            $units = $this->user->fetchAllUnits();

            // Pass the fetched units to the view
            include 'views/user/units.php'; // Include the view with the units data
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            echo "Error fetching units: " . $e->getMessage();
            // Optionally log the error or redirect to an error page
        }
    }
    
    public function login(){
        include 'views/user/login.php';
    }

    public function signup(){
        include 'views/user/signup.php';
    }

    public function home(){
        include 'views/user/home.php';
    }

    public function units(){
        $this->fetchUnits();
    }

    public function unitDetail(){
        if(isset($_GET['unitID'])){
            $unitID = $_GET['unitID'];
            $unitDetails = $this->user->unitDetails($unitID);
            $reservedDetails = $this->res_unit->getReservedDates($unitID);
            if($unitDetails || $reservedDetails){
                include 'views/user/unit_details.php';
            } else {
                echo "No unit found with this ID.";
            }
        } else {
            echo "Unit ID not provided.";
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: /RGarage/");
        exit();
    }

    public function showHonda(){
        $units = $this->unit->showAllHonda();
        if($units){
            include 'views/honda_page.php';
        }
    }

    public function showKawasaki(){
        $units = $this->unit->showAllKawasaki();
        if($units){
            include 'views/kawasaki_page.php';
        }
    }

    public function showYamaha(){
        $units = $this->unit->showAllYamaha();
        if($units){
            include 'views/yamaha_page.php';
        }
    }

    public function showSuzuki(){
        $units = $this->unit->showAllSuzuki();
        if($units){
            include 'views/suzuki_page.php';
        }
    }

    public function displaySearch(){
        // Check if a search key is provided
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearch($key);
        } else {
            // Fetch all units if the search key is empty
            $units = $this->unit->fetchAllUnits();
        }
    
        // Get the count of results
        $unitCount = count($units);
    
        // Return response with both units and count
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchHonda(){
        // Check if a search key is provided
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchHonda($key);
        } else {
            // Fetch all units if the search key is empty
            $units = $this->unit->showAllHonda();
        }
    
        // Get the count of results
        $unitCount = count($units);
    
        // Return response with both units and count
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchKawasaki(){
        // Check if a search key is provided
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchKawasaki($key);
        } else {
            // Fetch all units if the search key is empty
            $units = $this->unit->showAllKawasaki();
        }
    
        // Get the count of results
        $unitCount = count($units);
    
        // Return response with both units and count
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchSuzuki(){
        // Check if a search key is provided
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchSuzuki($key);
        } else {
            // Fetch all units if the search key is empty
            $units = $this->unit->showAllSuzuki();
        }
    
        // Get the count of results
        $unitCount = count($units);
    
        // Return response with both units and count
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchYamaha(){
        // Check if a search key is provided
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchYamaha($key);
        } else {
            // Fetch all units if the search key is empty
            $units = $this->unit->showAllYamaha();
        }
    
        // Get the count of results
        $unitCount = count($units);
    
        // Return response with both units and count
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    // Method to filter units based on type and price order (low-high or high-low)
public function filterUnits() {
    // Get filter parameters from GET request and sanitize
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    // Call the model's filterUnits method to get filtered data
    $units = $this->unit->filterUnits($type, $price);
    // Get the count of results
    $unitCount = count($units);
    
    // Prepare the response
    $response = [
        'status' => 'success',
        'data' => $units,  // Ensure 'data' is always an array
        'count' => $unitCount
    ];

    // If no units found, return an error message
    if (empty($units)) {
        $response = [
            'status' => 'error',
            'message' => 'No units found.'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

public function filterHondaUnits() {
    // Get filter parameters from GET request and sanitize
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    // Call the model's filterUnits method to get filtered data
    $units = $this->unit->filterHondaUnits($type, $price);
    // Get the count of results
    $unitCount = count($units);
    
    // Prepare the response
    $response = [
        'status' => 'success',
        'data' => $units,  // Ensure 'data' is always an array
        'count' => $unitCount
    ];

    // If no units found, return an error message
    if (empty($units)) {
        $response = [
            'status' => 'error',
            'message' => 'No units found.'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

public function filterKawasakiUnits() {
    // Get filter parameters from GET request and sanitize
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    // Call the model's filterUnits method to get filtered data
    $units = $this->unit->filterKawasakiUnits($type, $price);
    // Get the count of results
    $unitCount = count($units);
    
    // Prepare the response
    $response = [
        'status' => 'success',
        'data' => $units,  // Ensure 'data' is always an array
        'count' => $unitCount
    ];

    // If no units found, return an error message
    if (empty($units)) {
        $response = [
            'status' => 'error',
            'message' => 'No units found.'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

public function filterSuzukiUnits() {
    // Get filter parameters from GET request and sanitize
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    // Call the model's filterUnits method to get filtered data
    $units = $this->unit->filterSuzukiUnits($type, $price);
    // Get the count of results
    $unitCount = count($units);
    
    // Prepare the response
    $response = [
        'status' => 'success',
        'data' => $units,  // Ensure 'data' is always an array
        'count' => $unitCount
    ];

    // If no units found, return an error message
    if (empty($units)) {
        $response = [
            'status' => 'error',
            'message' => 'No units found.'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

public function filterYamahaUnits() {
    // Get filter parameters from GET request and sanitize
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    // Call the model's filterUnits method to get filtered data
    $units = $this->unit->filterYamahaUnits($type, $price);
    // Get the count of results
    $unitCount = count($units);
    
    // Prepare the response
    $response = [
        'status' => 'success',
        'data' => $units,  // Ensure 'data' is always an array
        'count' => $unitCount
    ];

    // If no units found, return an error message
    if (empty($units)) {
        $response = [
            'status' => 'error',
            'message' => 'No units found.'
        ];
    }

    // Return the response as JSON
    echo json_encode($response);
}

    
    
    


}