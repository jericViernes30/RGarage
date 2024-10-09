<?php
include_once 'controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? null;

// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in (session variable example)
$isLoggedIn = isset($_SESSION['user']);

switch ($action) {
    case 'user/auth/create':
        $controller->createUser();
        break;
    case 'user/login':
        $controller->login();
        break;
    case 'user/signup':
        $controller->signup();
        break;
    case 'user/auth/login':
        $controller->authLogin();
        break;
    case 'user/home':
        $controller->home();
        break;
    case 'user/logout':
        if ($isLoggedIn) {
            $controller->logout();
        } else {
            header("Location: /RGarage/user/login");
            exit();
        }
        break;
    default:
        include 'views/landing_page.php';
        break;
}


?>