<?php
include_once 'controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? null;

if ($action === 'user/create-user') {
    $controller->create();
} elseif ($action === 'index') {
    $controller->index();
} else {
    include 'views/landing_page.php';
}
?>