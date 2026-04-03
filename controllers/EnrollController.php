<?php
require_once __DIR__ . "/../models/enroll.php";

class EnrollController {

    public function assign() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            (new Enroll())->assign($_POST['student_id'], $_POST['lesson_id']);
        }
        header("Location: dashboard.php");
        exit;
    }
}