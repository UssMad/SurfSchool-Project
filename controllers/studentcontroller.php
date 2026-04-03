<?php
require_once __DIR__ . "/../models/enroll.php";
require_once __DIR__ . "/../models/student.php";

class StudentController {

    public function agenda() {
        if (session_status() == PHP_SESSION_NONE) session_start();

        // Protection: must be logged in
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit;
        }

        $user = $_SESSION['user'];
        $lessons = (new Enroll())->getByStudent($user['id']);
        $student = (new Student())->getByUserId($user['id']);

        include __DIR__ . "/../views/student/agenda.php";
    }
}