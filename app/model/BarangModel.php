<?php
namespace Model;

require_once __DIR__ . '/../core/Database.php'; // Pastikan path sesuai

use Core\Database;
use PDO;
use Exception;

class BarangModel {
    private $conn;
    private $table_name = "tbl_barang";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllBarang() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function getBarangByUser($userId) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id_user";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_user', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function addBarang($nama, $harga, $kondisi, $jenis, $gambar, $deskripsi, $nomor_penjual) {
        // Tentukan direktori untuk menyimpan gambar
        $targetDir = "/var/www/html/tokobekas/public/images/fotobarang/";
        $targetFile = $targetDir . basename($gambar['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        

        // Validasi file gambar (ekstensi file)
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($gambar['tmp_name'], $targetFile)) {
                // Gambar berhasil dipindahkan
                $query = "INSERT INTO barang (nama, harga, kondisi, jenis, gambar, deskripsi, nomor_penjual) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("sssssss", $nama, $harga, $kondisi, $jenis, $targetFile, $deskripsi, $nomor_penjual);
                $stmt->execute();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }



public function updateBarang($id, $status) {
    $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public function deleteBarang($id) {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}



}
