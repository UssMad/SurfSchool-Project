<?php
session_start();

/* Simple navigation — redirect to public entry points */

if (!isset($_SESSION['user'])) {
    header("Location: public/login.php");
    exit;
}

$user = $_SESSION['user'];

if ($user['role'] == 'admin') {
    header("Location: public/dashboard.php");
} else {
    header("Location: public/my_lessons.php");
}
exit;