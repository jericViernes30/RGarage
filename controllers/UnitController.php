<?php
session_start(); // Start the session to access $_SESSION['user']

// Include the model
include_once 'models/Message.php';
include_once 'config/Database.php'; // Include the database connection class