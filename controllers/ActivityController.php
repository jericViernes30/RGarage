<?php

include_once 'models/Activity.php';
include_once 'config/Database.php'; // Include the database connection class

class ActivityController{
    private $activity;

    public function __construct() {
        // Get the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Pass the connection to the User model
        $this->activity = new Unit($db);
    }
}