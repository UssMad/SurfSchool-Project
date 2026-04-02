<?php
require_once 'config/database.php';

class User {
   private $conn;

   public function __construct() {
        $db = new Database();
        $this->conn = $db-> connect();
    }

    public function FindByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users where email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    public function create ($email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (email,password,role) VALUES (?,?,'student')");
        return $stmt->execute([$email, $hash]);
    }
}
?>
 