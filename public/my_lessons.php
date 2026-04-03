<?php
session_start();
require_once __DIR__ . "/../controllers/StudentController.php";

// Protection
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$controller = new StudentController();
$controller->agenda();
