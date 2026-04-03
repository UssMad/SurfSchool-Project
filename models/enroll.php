<?php
require_once __DIR__ . "/../config/database.php";

class Enroll {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->connect();
    }

    public function getAll() {
        return $this->conn->query("
            SELECT lessons_student.*, students.name, lessons.title, lessons.date_time, lessons.coach
            FROM lessons_student
            JOIN students ON students.id = lessons_student.student_id
            JOIN lessons ON lessons.id = lessons_student.lesson_id
            ORDER BY lessons.date_time DESC
        ")->fetchAll();
    }

    public function assign($student_id, $lesson_id) {
        $stmt = $this->conn->prepare(
            "INSERT INTO lessons_student (student_id, lesson_id, payment_status) VALUES (?, ?, 'Pending')"
        );
        return $stmt->execute([$student_id, $lesson_id]);
    }

    public function getByStudent($user_id) {
        $stmt = $this->conn->prepare("
            SELECT lessons_student.*, lessons.title, lessons.coach, lessons.date_time
            FROM lessons_student
            JOIN students ON students.id = lessons_student.student_id
            JOIN lessons ON lessons.id = lessons_student.lesson_id
            WHERE students.user_id = ?
            ORDER BY lessons.date_time ASC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function updatePayment($student_id, $lesson_id, $status) {
        $stmt = $this->conn->prepare(
            "UPDATE lessons_student SET payment_status=? 
             WHERE student_id=? AND lesson_id=?"
        );
        return $stmt->execute([$status, $student_id, $lesson_id]);
    }

    public function countPaid() {
        return $this->conn->query("
            SELECT COUNT(*) as total FROM lessons_student WHERE payment_status='Paid'
        ")->fetch()['total'];
    }

    public function countPending() {
        return $this->conn->query("
            SELECT COUNT(*) as total FROM lessons_student WHERE payment_status='Pending'
        ")->fetch()['total'];
    }
}
?>