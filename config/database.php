<?php 
class DB {
    private $host = 'localhost';
    private $db = "surfschool_db";
    private $user = 'root';
    private $pass = '';

    public function connect() {
        try {
            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $pdo;
    }
}
?>
