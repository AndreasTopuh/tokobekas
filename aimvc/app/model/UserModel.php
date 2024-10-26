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

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Cek apakah ada pengguna dan password cocok
        if ($user && $user['password'] === $password) { // Bandingkan password dalam bentuk plaintext

            return $user; // Jika password cocok
        }
        return false; // Jika tidak cocok
    }

    public function register($nama, $email, $password) {
        $query = "INSERT INTO " . $this->table_name . " (nama, email, password) VALUES (:nama, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Simpan password dalam bentuk plaintext
        return $stmt->execute();
    }

    public function emailExists($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
}
