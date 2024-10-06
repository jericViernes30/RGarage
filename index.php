<?php
include_once 'controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? null;

if ($action === 'user/auth/create') {
    $controller->authLogin();
} elseif ($action === 'index') {
    $controller->index();
} elseif ($action === 'user/login') {
    $controller->login();
} elseif ($action === 'user/signup') {
    $controller->signup();
} else {
    include 'views/landing_page.php';
}
?>