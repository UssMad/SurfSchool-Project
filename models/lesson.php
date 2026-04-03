<?php
require_once __DIR__ . "/../config/database.php";

class Lesson {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->connect();
    }

    public function getAll($date = null) {
        if ($date) {
            $stmt = $this->conn->prepare("SELECT * FROM lessons WHERE DATE(date_time)=?");
            $stmt->execute([$date]);
            return $stmt->fetchAll();
        }

        return $this->conn->query("SELECT * FROM lessons ORDER BY date_time DESC")->fetchAll();
    }

    public function create($title, $coach, $date) {
        $stmt = $this->conn->prepare(
            "INSERT INTO lessons (title, coach, date_time) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$title, $coach, $date]);
    }

    public function update($id, $title, $coach, $date) {
        $stmt = $this->conn->prepare(
            "UPDATE lessons SET title=?, coach=?, date_time=? WHERE id=?"
        );
        return $stmt->execute([$title, $coach, $date, $id]);
    }

    public function delete($id) {
        // First delete enrollments for this lesson
        $stmt = $this->conn->prepare("DELETE FROM lessons_student WHERE lesson_id=?");
        $stmt->execute([$id]);
        // Then delete the lesson
        $stmt = $this->conn->prepare("DELETE FROM lessons WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function count() {
        return $this->conn->query("SELECT COUNT(*) as total FROM lessons")->fetch()['total'];
    }
}
?>