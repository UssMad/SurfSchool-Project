<?php
require_once __DIR__ . "/../config/database.php";

class Student {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->connect();
    }

    public function create($user_id, $name, $country, $level) {
        $stmt = $this->conn->prepare(
            "INSERT INTO students (user_id, name, country, level) VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([$user_id, $name, $country, $level]);
    }

    public function getAll($search = null) {
        if ($search) {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE name LIKE ? OR country LIKE ?");
            $stmt->execute(["%$search%", "%$search%"]);
            return $stmt->fetchAll();
        }

        return $this->conn->query("SELECT * FROM students")->fetchAll();
    }

    public function getByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE user_id=?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function updateLevel($id, $level) {
        $stmt = $this->conn->prepare("UPDATE students SET level=? WHERE id=?");
        return $stmt->execute([$level, $id]);
    }

    public function update($id, $name, $country, $level) {
        $stmt = $this->conn->prepare(
            "UPDATE students SET name=?, country=?, level=? WHERE id=?"
        );
        return $stmt->execute([$name, $country, $level, $id]);
    }

    public function delete($id) {
        // 1. Get user_id before deleting the student record
        $stmt = $this->conn->prepare("SELECT user_id FROM students WHERE id = ?");
        $stmt->execute([$id]);
        $student = $stmt->fetch();
        $user_id = $student ? $student['user_id'] : null;

        // 2. Delete all related enrollments first (Fixes the Foreign Key error)
        $stmt = $this->conn->prepare("DELETE FROM lessons_student WHERE student_id = ?");
        $stmt->execute([$id]);

        // 3. Delete the student profile
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $result = $stmt->execute([$id]);

        // 4. Delete the associated user login account
        if ($user_id) {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
        }

        return $result;
    }

    public function count() {
        return $this->conn->query("SELECT COUNT(*) as total FROM students")->fetch()['total'];
    }

    public function countByLevel() {
        return $this->conn->query("
            SELECT level, COUNT(*) as total FROM students GROUP BY level
        ")->fetchAll();
    }
}
?>