<?php
namespace Model;

require_once __DIR__ . '/../core/Database.php'; // Pastikan path sesuai

use Core\Database;
use PDO;
use Exception;

class BarangModel {
    private $conn;
    private $table_name = "tbl_barang";  // Nama tabel barang

    // Konstruktor untuk koneksi ke database
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mendapatkan semua barang dari database
    public function getAllBarang() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendapatkan barang berdasarkan jenis
    public function getBarangByJenis($jenis) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE jenis = :jenis";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':jenis', $jenis, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mendapatkan barang berdasarkan ID pengguna
    public function getBarangByUser($userId) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan barang ke database
    public function addBarang($data, $userId) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nama, harga, kondisi, jenis, status, nomor_penjual, deskripsi, gambar, id_user) 
                  VALUES (:nama, :harga, :kondisi, :jenis, :status, :nomor_penjual, :deskripsi, :gambar, :id_user)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':kondisi', $data['kondisi']);
        $stmt->bindParam(':jenis', $data['jenis']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':nomor_penjual', $data['nomor_penjual']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':gambar', $data['gambar']); // Menyimpan nama gambar
        $stmt->bindParam(':id_user', $userId);

        return $stmt->execute();
    }

    // Mengupdate status barang
    public function updateBarang($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Menghapus barang berdasarkan ID
    public function deleteBarang($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
