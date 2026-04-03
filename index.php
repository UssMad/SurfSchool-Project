<?php
session_start();

/* 
   Main Entry Point: 
   If logged in, redirect to appropriate dashboard.
   If guest, show the new premium landing page.
*/


if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user['role'] == 'admin') {
        header("Location: public/dashboard.php");
    } else {
        header("Location: public/my_lessons.php");
    }
    exit;
}

// Show Landing Page for guests
include __DIR__ . "/views/home.php";
exit;