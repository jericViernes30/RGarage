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
                $_SESSION['user_id'] = $authResult['user']['id'];
                $_SESSION['first_name'] = $authResult['user']['first_name'];
                $_SESSION['last_name'] = $authResult['user']['last_name'];
                $_SESSION['email_address'] = $authResult['user']['email_address'];
                $_SESSION['address'] = $authResult['user']['address'];
                $_SESSION['contact_number'] = $authResult['user']['contact_number'];
                echo "<script>
                    alert('Success: You\'re now logged in.');
                    window.location.href = '/RGarage/user/home'; // Redirect to dashboard or homepage
                </script>";
            } else {
                echo "<script>
                    alert('Error: " . $authResult['message'] . "');
                    window.location.href = '/RGarage/user/auth/login'; // Redirect back to login page
                </script>";
            }
        }
    }
    
    public function getDetails(){

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

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: /RGarage/");
        exit();
    }
}