<?php
session_start();
require_once __DIR__ . "/../controllers/AdminController.php";

// Protection
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$controller = new AdminController();

// Handle actions via GET parameter
$action = $_GET['action'] ?? $_POST['action'] ?? 'dashboard';

switch ($action) {
    case 'createLesson':
        $controller->createLesson();
        break;
    case 'createStudent':
        $controller->createStudent();
        break;
    case 'updateLesson':
        $controller->updateLesson();
        break;
    case 'deleteLesson':
        $controller->deleteLesson();
        break;
    case 'updateStudentLevel':
        $controller->updateStudentLevel();
        break;
    case 'deleteStudent':
        $controller->deleteStudent();
        break;
    case 'updateStudent':
        $controller->updateStudent();
        break;
    case 'enrollStudent':
        $controller->enrollStudent();
        break;
    case 'updatePayment':
        $controller->updatePayment();
        break;
    default:
        $controller->dashboard();
        break;
}
