<?php


require 'vendor/autoload.php';
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

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $repeat_password = $_POST['repeat_password'] ?? '';
            $activity = 'Register';
    
            // Check if passwords match
            if ($password === $repeat_password) {
                $first_name = $_POST['first_name'] ?? '';
                $last_name = $_POST['last_name'] ?? '';
                $email_address = $_POST['email_address'] ?? '';
                $contact_number = $_POST['contact_number'] ?? '';
                $address = $_POST['address'] ?? '';
    
                // Create the user instance and set its properties
                $this->user->first_name = $first_name;
                $this->user->last_name = $last_name;
                $this->user->email_address = $email_address;
                $this->user->contact_number = $contact_number;
                $this->user->address = $address;
                $this->user->password = $password;
    
                // Handle profile picture upload if exists
                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                    $profilePicture = $_FILES['profile_picture'];
    
                    // Create user and send email verification (Handled by User model)
                    if ($this->user->createUser($profilePicture)) {
                        // Respond with success message
                        echo json_encode([
                            "status" => "success",
                            "message" => "User registered successfully! Please check your email for the verification code."
                        ]);
                    } else {
                        // Handle error in user creation
                        http_response_code(500);
                        echo json_encode([
                            "status" => "error",
                            "message" => "Could not create user. Please try again."
                        ]);
                    }
                } else {
                    // Handle file upload error
                    http_response_code(400);
                    echo json_encode([
                        "status" => "error",
                        "message" => "Error uploading profile picture. Ensure the file is valid."
                    ]);
                }
            } else {
                // Handle password mismatch error
                http_response_code(400);
                echo json_encode([
                    "status" => "error",
                    "message" => "Passwords do not match."
                ]);
            }
        } else {
            // Handle invalid request method
            http_response_code(405);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid request method."
            ]);
        }
    }
    
    

    public function verificationView(){
        include 'views/user/verification.php';
    }
    
    public function verifyEmail() {
        try {
            // Get email from POST data
            $email = $_POST['email'] ?? null;
    
            if (!$email) {
                // Return a response if email is not provided
                echo json_encode([
                    'success' => false,
                    'message' => 'Email is required.'
                ]);
                return;
            }
    
            // Check if the email exists in the database
            $exists = $this->user->checkEmailExistence($email);
    
            if ($exists) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Email exists in the database.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Email does not exist.'
                ]);
            }
        } catch (Exception $e) {
            // Handle unexpected exceptions
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    public function matchCodes(){
        $email = $_POST['email'];
        $verification_code = $_POST['code'];

        $matched = $this->user->matchCodes($email, $verification_code);

        if ($matched) {
            echo json_encode([
                'success' => true,
                'message' => 'Account successfully verified!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Account verification failed.'
            ]);
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
                    'profile' => $authResult['user']['profile'],
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
                $units = $this->unit->fetchAllUnits();
            } else {
                echo "<script>
                    alert('Error: " . $authResult['message'] . "');
                    window.location.href = '/RGarage/user/login'; // Redirect back to login page
                </script>";
            }
        }
    }
    
    public function fetchUnits(){
        try {
            $units = $this->user->fetchAllUnits();
            include 'views/user/units.php';
        } catch (Exception $e) {
            echo "Error fetching units: " . $e->getMessage();
        }
    }

    public function fetchUnitsHome(){
        try {
            $average = $this->res_unit->averageRating() ?: 0;
            $units = $this->user->fetchAllUnitsRandom();
            include 'views/landing_page.php';
        } catch (Exception $e) {
            echo "Error fetching units: " . $e->getMessage();
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
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearch($key);
        } else {
            $units = $this->unit->fetchAllUnits();
        }
        $unitCount = count($units);
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchHonda(){
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchHonda($key);
        } else {
            $units = $this->unit->showAllHonda();
        }
    
        $unitCount = count($units);
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchKawasaki(){
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchKawasaki($key);
        } else {
            $units = $this->unit->showAllKawasaki();
        }
        $unitCount = count($units);
    
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchSuzuki(){
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchSuzuki($key);
        } else {
            $units = $this->unit->showAllSuzuki();
        }
    
        $unitCount = count($units);
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

    public function displaySearchYamaha(){
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $key = $_GET['key'];
            $units = $this->unit->livesearchYamaha($key);
        } else {
            $units = $this->unit->showAllYamaha();
        }
        $unitCount = count($units);
        if($units){
            echo json_encode(['status' => 'success', 'data' => $units, 'count' => $unitCount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No units found.']);
        }
    }

public function filterUnits() {
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';

    $units = $this->unit->filterUnits($type, $price);
    $unitCount = count($units);
    $response = [
        'status' => 'success',
        'data' => $units,
        'count' => $unitCount
    ];
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

    public function userReservedUnits(){
        if(isset($_GET['user_id'])){
            $id = $_GET['user_id'];
            $units = $this->res_unit->fetchUserReservedUnits($id);
            include 'views/user/reserved_units.php';
        } else {
            echo "User ID is missing!";
        }
    }
}