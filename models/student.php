<?php
require_once 'config/database.php';

class student {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db-> connect();
    }
    public function create($user_id,$name,$country,$level) {
        $stmt = $this->conn->prepare("INSERT INTO students (user_id,name,country,level) VALUES (?,?,?,?)");
        return $stmt->execute([$user_id,$name,$country,$level]);
    }
}
?>