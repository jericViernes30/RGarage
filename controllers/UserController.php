<?php

include_once 'models/User.php';
include_once 'config/Database.php'; // Include the database connection class

class UserController {
    private $user;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->user = new User($db);
    }

    public function createUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat_password'];

            if($password == $repeat_password){
                $this->user->first_name = $_POST['first_name'];
                $this->user->last_name = $_POST['last_name'];
                $this->user->email_address = $_POST['email_address'];
                $this->user->contact_number = $_POST['contact_number'];
                $this->user->address = $_POST['address'];
                $this->user->password = $_POST['password'];

                if ($this->user->createUser()) {
                    echo "User registered successfully!";
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
            if($unitDetails){
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
}