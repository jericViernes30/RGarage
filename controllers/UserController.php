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

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            $this->user->create();
            header("Location: index.php");
        } else {
            include_once 'views/user/create.php';
        }
    }
}