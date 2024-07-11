<?php
class DatabaseConnection {
    protected $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        // Your database connection details
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'admin';

        // Create a new MySQLi connection
        $this->conn = new mysqli($host, $username, $password, $database);

        // Check for a connection error and handle it
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
