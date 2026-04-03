<?php
require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../models/student.php";

class AuthController {

    public function login() {
        if (session_status() == PHP_SESSION_NONE) session_start();

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Please fill in all fields.";
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;

                    if ($user['role'] == 'admin') {
                        header("Location: dashboard.php");
                    } else {
                        header("Location: my_lessons.php");
                    }
                    exit;
                } else {
                    $error = "Invalid email or password.";
                }
            }
        }

        include __DIR__ . "/../views/auth/login.php";
    }

    public function register() {
        if (session_status() == PHP_SESSION_NONE) session_start();

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $name = trim($_POST['name'] ?? '');
            $country = trim($_POST['country'] ?? '');
            $level = $_POST['level'] ?? 'Beginner';

            if (empty($email) || empty($password) || empty($name) || empty($country)) {
                $error = "Please fill in all fields.";
            } else {
                $userModel = new User();

                // Check if email already exists
                $existing = $userModel->findByEmail($email);
                if ($existing) {
                    $error = "This email is already registered.";
                } else {
                    $userId = $userModel->create($email, $password);

                    (new Student())->create(
                        $userId,
                        $name,
                        $country,
                        $level
                    );

                    $success = "Account created! You can now login.";
                }
            }
        }

        include __DIR__ . "/../views/auth/register.php";
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}