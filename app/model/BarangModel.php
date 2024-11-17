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



public function addBarang($data, $userId) {
    // Periksa apakah file gambar ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // Tentukan folder tujuan untuk menyimpan gambar
        $folderPath = $_SERVER['DOCUMENT_ROOT'] . "/tokobekas/public/images/fotobarang/";

        // Pastikan folder tujuan ada
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);  // Membuat folder jika belum ada
        }

        // Tentukan path gambar yang disimpan di folder 'public/images/fotobarang/'
        $gambarPath = "images/fotobarang/" . $gambar;  // Path relatif yang akan disimpan di database

        // Pindahkan file gambar ke folder tujuan
        if (!move_uploaded_file($tmp, $folderPath . $gambar)) {
            throw new Exception("Gagal mengupload gambar.");
        }
    } else {
        throw new Exception("File gambar tidak ada atau terjadi kesalahan saat upload.");
    }

    // Query untuk menambahkan data barang beserta path gambar
    $query = "INSERT INTO " . $this->table_name . " 
              (nama, harga, kondisi, jenis, status, nomor_penjual, deskripsi, id_user, gambar) 
              VALUES (:nama, :harga, :kondisi, :jenis, :status, :nomor_penjual, :deskripsi, :id_user, :gambar)";
    
    // Siapkan statement
    $stmt = $this->conn->prepare($query);

    // Binding parameter
    $stmt->bindParam(':nama', $data['nama']);
    $stmt->bindParam(':harga', $data['harga']);
    $stmt->bindParam(':kondisi', $data['kondisi']);
    $stmt->bindParam(':jenis', $data['jenis']);
    $stmt->bindParam(':status', $data['status']);
    $stmt->bindParam(':nomor_penjual', $data['nomor_penjual']);
    $stmt->bindParam(':deskripsi', $data['deskripsi']);
    $stmt->bindParam(':id_user', $userId);
    $stmt->bindParam(':gambar', $gambarPath);  // Menyimpan path relatif ke gambar

    // Eksekusi query dan kembalikan hasilnya
    return $stmt->execute();
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
