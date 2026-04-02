<?php
require_once 'config/database.php';

class lessons {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db-> connect();
    }

    public function create($title, $coach, $date) {
        $stmt = $this->conn->prepare("INSERT INTO lessons (title,coach,date_time) VALUES (?,?,?)");
        return $stmt->execute([$title, $coach, $date]);
    }
}
?>

