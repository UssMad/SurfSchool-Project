<?php
require_once __DIR__ . "/../config/database.php";

class Admin {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->connect(); 
    }

    // get all students
    public function getStudents() {
        return $this->conn->query("SELECT * FROM students")->fetchAll();
    }

    // get all lessons
    public function getLessons() {
        return $this->conn->query("SELECT * FROM lessons")->fetchAll();
    }

    // get all enrollments (with payment)
    public function getEnrollments() {
        return $this->conn->query("
            SELECT lessons_student.*, students.name, lessons.title
            FROM lessons_student
            JOIN students ON students.id = lessons_student.student_id
            JOIN lessons ON lessons.id = lessons_student.lesson_id
        ")->fetchAll();
    }

    // stats
    public function getStats() {
        $students = $this->conn->query("SELECT COUNT(*) FROM students")->fetchColumn();
        $lessons = $this->conn->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
        $paid = $this->conn->query("SELECT COUNT(*) FROM lessons_student WHERE payment_status='Paid'")->fetchColumn();

        return [
            'students' => $students,
            'lessons' => $lessons,
            'paid' => $paid
        ];
    }
}