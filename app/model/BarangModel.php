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



// public function addBarang($data, $userId) {
//     if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
//         $target_dir = "/var/www/html/tokobekas/public/images/fotobarang/";
//         $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
//         if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
//             echo "The file ". basename($_FILES["gambar"]["name"]). " has been uploaded.";
//         } else {
//             throw new Exception("Gagal mengupload gambar.");
//         }
//     } else {
//         throw new Exception("File gambar tidak ada atau terjadi kesalahan saat upload.");
//     }


//     // Query untuk menambahkan data barang beserta path gambar
//     $query = "INSERT INTO " . $this->table_name . " 
//               (nama, harga, kondisi, jenis, status, nomor_penjual, deskripsi, id_user, gambar) 
//               VALUES (:nama, :harga, :kondisi, :jenis, :status, :nomor_penjual, :deskripsi, :id_user, :gambar)";
    
//     // Siapkan statement
//     $stmt = $this->conn->prepare($query);

//     // Binding parameter
//     $stmt->bindParam(':nama', $data['nama']);
//     $stmt->bindParam(':harga', $data['harga']);
//     $stmt->bindParam(':kondisi', $data['kondisi']);
//     $stmt->bindParam(':jenis', $data['jenis']);
//     $stmt->bindParam(':status', $data['status']);
//     $stmt->bindParam(':nomor_penjual', $data['nomor_penjual']);
//     $stmt->bindParam(':deskripsi', $data['deskripsi']);
//     $stmt->bindParam(':id_user', $userId);
//     $stmt->bindParam(':gambar', $gambarPath);  // Menyimpan path relatif ke gambar

//     // Eksekusi query dan kembalikan hasilnya
//     return $stmt->execute();
// }

public function addBarang($data, $userId) {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        // Tentukan folder tempat gambar akan disimpan
        $target_dir = "/var/www/html/tokobekas/public/images/fotobarang/";
        // Tentukan nama file yang akan disimpan
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        
        // Pindahkan file yang diupload ke folder yang ditentukan
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Jika berhasil, kita simpan nama file untuk dimasukkan ke database
            $gambarFileName = basename($_FILES["gambar"]["name"]);
        } else {
            throw new Exception("Gagal mengupload gambar.");
        }
    } else {
        throw new Exception("File gambar tidak ada atau terjadi kesalahan saat upload.");
    }

    // Query untuk menambahkan data barang beserta nama file gambar
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
    
    // Menyimpan nama file gambar ke database (bukan path absolut)
    $stmt->bindParam(':gambar', $gambarFileName);  // Hanya nama file, bukan path lengkap

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
