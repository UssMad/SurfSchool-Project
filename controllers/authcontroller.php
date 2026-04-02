<?php
require_once "../models/User.php";
require_once "../models/Student.php";



class AuthController {

    public function login() {
        session_start();

        public $message;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User();
            $user = $userModel->findByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;

                if ($user['role'] == 'admin') {
                    header("Location: dashboard.php");
                } else {
                    header("Location: my_lessons.php");
                }
                exit;
            } else {
                $this->message = "Invalid login";
            }
        }

        include "../views/login.php";
    }

    public function register () {
        $userModel = new User();
        $user = $userModel->findByEmail($_POST['email']);

        if ($user['email'] == $_POST["email"]) {
            $this->message = "Email already exists";
        } 
}

?>