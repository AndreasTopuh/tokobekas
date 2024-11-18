<?php
namespace Model;

use Core\Database;
use PDO;

class UserModel {
    private $conn;
    private $table_name = "tbl_user";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Authenticate a user during login.
     * 
     * @param string $email User's email
     * @return mixed User data if successful, null if failure
     */
    public function login($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Fetch user data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Register a new user in the database.
     * 
     * @param string $nama User's name
     * @param string $email User's email
     * @param string $password Hashed password
     * @return bool True on success, false on failure
     */
    public function register($nama, $email, $password) {
        $query = "INSERT INTO " . $this->table_name . " (nama, email, password) 
                  VALUES (:nama, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Store hashed password
        return $stmt->execute();
    }

    /**
     * Check if email already exists in the database.
     * 
     * @param string $email User's email
     * @return bool True if email exists, false otherwise
     */
    public function emailExists($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
}
