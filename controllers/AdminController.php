<?php
require_once __DIR__ . "/../models/student.php";
require_once __DIR__ . "/../models/lesson.php";
require_once __DIR__ . "/../models/enroll.php";
require_once __DIR__ . "/../models/user.php";


class AdminController {

    public function dashboard() {
        if (session_status() == PHP_SESSION_NONE) session_start();

        // Protection: only admin can access
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        $search = $_GET['search'] ?? null;
        $date = $_GET['date'] ?? null;

        $studentModel = new Student();
        $lessonModel = new Lesson();
        $enrollModel = new Enroll();

        $students = $studentModel->getAll($search);
        $lessons = $lessonModel->getAll($date);
        $enrolls = $enrollModel->getAll();

        // stats
        $totalStudents = $studentModel->count();
        $totalLessons = $lessonModel->count();
        $paid = $enrollModel->countPaid();
        $pending = $enrollModel->countPending();

        // chart data
        $levelData = $studentModel->countByLevel();

        include __DIR__ . "/../views/admin/dashboard.php";
    }

    public function createLesson() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title'] ?? '');
            $coach = trim($_POST['coach'] ?? '');
            $date = $_POST['date_time'] ?? '';

            if (!empty($title) && !empty($coach) && !empty($date)) {
                (new Lesson())->create($title, $coach, $date);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'lessons';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function updateLesson() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $title = trim($_POST['title'] ?? '');
            $coach = trim($_POST['coach'] ?? '');
            $date = $_POST['date_time'] ?? '';

            if (!empty($id) && !empty($title) && !empty($coach) && !empty($date)) {
                (new Lesson())->update($id, $title, $coach, $date);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'lessons';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function deleteLesson() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if (isset($_GET['id'])) {
            (new Lesson())->delete($_GET['id']);
        }
        $tab = $_REQUEST['tab'] ?? 'lessons';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function updateStudentLevel() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $level = $_POST['level'] ?? '';

            if (!empty($id) && !empty($level)) {
                (new Student())->updateLevel($id, $level);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'students';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function updateStudent() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $name = trim($_POST['name'] ?? '');
            $country = trim($_POST['country'] ?? '');
            $level = $_POST['level'] ?? '';

            if (!empty($id) && !empty($name) && !empty($country) && !empty($level)) {
                (new Student())->update($id, $name, $country, $level);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'students';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function deleteStudent() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if (isset($_GET['id'])) {
            (new Student())->delete($_GET['id']);
        }
        $tab = $_REQUEST['tab'] ?? 'students';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function enrollStudent() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $student_id = $_POST['student_id'] ?? '';
            $lesson_id = $_POST['lesson_id'] ?? '';

            if (!empty($student_id) && !empty($lesson_id)) {
                (new Enroll())->assign($student_id, $lesson_id);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'enrollments';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }

    public function updatePayment() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $student_id = $_POST['student_id'] ?? '';
            $lesson_id = $_POST['lesson_id'] ?? '';
            $status = $_POST['status'] ?? '';

            if (!empty($student_id) && !empty($lesson_id) && !empty($status)) {
                (new Enroll())->updatePayment($student_id, $lesson_id, $status);
            }
        }
        $tab = $_REQUEST['tab'] ?? 'enrollments';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }
    public function createStudent() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        
        // Protection: only admin can access
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $country = trim($_POST['country'] ?? '');
            $level = $_POST['level'] ?? 'Beginner';

            if (!empty($name) && !empty($email) && !empty($password)) {
                $userModel = new User();
                
                // Check if email already exists
                if (!$userModel->findByEmail($email)) {
                    // 1. Create User
                    $user_id = $userModel->create($email, $password);
                    
                    if ($user_id) {
                        // 2. Create Student profile
                        (new Student())->create($user_id, $name, $country, $level);
                    }
                }
            }
        }
        $tab = $_REQUEST['tab'] ?? 'students';
        header("Location: dashboard.php?tab=" . $tab);
        exit;
    }
}