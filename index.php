<?php
include_once 'controllers/UserController.php';
include_once 'controllers/AdminController.php';
include_once 'controllers/MessageController.php';

$controller = new UserController();
$adminController = new AdminController();
$messageController = new MessageController();
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

    case 'user/unitsAvailable':
        $controller->units();
        break;

    case 'user/unit-detail':
        $controller->unitDetail();
        break;

    case 'user/logout':
        if ($isLoggedIn) {
            $controller->logout();
        } else {
            header("Location: /RGarage/user/login");
            exit();
        }
        break;

    case 'user/send-message':
        $messageController->sendMessage();
        break;

    case 'user/messages/fetch':
        $messageController->fetchMessages();
        break;

    case 'admin/dashboard':
        $adminController->dashboard();
        break;

    case 'admin/units':
        $adminController->units();
        break;
    
    case 'admin/add-unit':
        $adminController->addUnit();
        break;

    case 'admin/delete-unit':
        $adminController->deleteUnit(); // Call deleteUnit without passing plate number directly
        break;

    case 'admin/messages':
        $messageController->displaySenders();
        break;

    case 'admin/get-message':
        $messageController->getMessagesBySenderName();
        break;

    case 'admin/send-message':
        $messageController->sendAdminMessage();
        break;

    case 'admin/get-recent-messages':
        $messageController->getRecentMessages();
        break;
        

    default:
        include 'views/landing_page.php';
        break;
}


?>