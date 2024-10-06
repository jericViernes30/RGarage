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

    public function index() {
        $result = $this->user->read();
        include_once 'views/user/index.php';
    }

    public function authLogin(){
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

                // Attempt to create the user
                if ($this->user->createUser()) {
                    // Redirect or display success message
                    echo "User registered successfully!";
                } else {
                    // Display error message
                    echo "Error: Could not create user.";
                }
            } else {
                echo "<script>
                    alert('Error: Passwords do not match.');
                    window.location.href = '/RGarage/user/signup';
                </script>";
                exit(); // Prevent further script execution
            }

        }
    }

    public function login(){
        include 'views/user/login.php';
    }

    public function signup(){
        include 'views/user/signup.php';
    }
}