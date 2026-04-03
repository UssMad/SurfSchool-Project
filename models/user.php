<?php
require_once __DIR__ . "/../config/database.php";

class User {
    private $conn;

    public function __construct() {
        $db = new DB();
        $this->conn = $db->connect();
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO users (email, password, role) VALUES (?, ?, 'student')"
        );

        $stmt->execute([$email, $hash]);
        return $this->conn->lastInsertId();
    }
}
?>