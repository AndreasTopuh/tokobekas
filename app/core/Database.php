<?php
namespace Core;

use PDO;
use PDOException;

// define base URL path
define("APP_PATH", "http://103.179.56.170/tokobekas/");


class Database {

    
    private $host = 'localhost';
    private $db_name = 'db_tokobekas';
    private $username = 'devops';
    private $password = ':hebGxdL~uui~24';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
