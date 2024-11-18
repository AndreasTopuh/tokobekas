<?php
namespace Controller;

require_once __DIR__ . '/../model/BarangModel.php'; // Pastikan path ini benar

use Model\BarangModel;
use Exception;

class BarangController {
    private $barangModel;

    public function __construct() {
        $this->barangModel = new BarangModel();
    }

    public function showAllBarang() {
        return $this->barangModel->getAllBarang();
    }

    public function addBarang($data, $userId) {
        return $this->barangModel->addBarang($data, $userId);
    }

    public function updateBarang($id, $status) {
        return $this->barangModel->updateBarang($id, $status);
    }

 public function handleRequest() {
    session_start();

    if (isset($_POST['add_barang'])) {
        $data = [
            'nama' => $_POST['nama'],
            'harga' => $_POST['harga'],
            'kondisi' => $_POST['kondisi'],
            'jenis' => $_POST['jenis'],
            'status' => $_POST['status'],
            'nomor_penjual' => $_POST['nomor_penjual'],
            'deskripsi' => $_POST['deskripsi'],
        ];

        // Mengecek jika ada file gambar yang diupload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $targetDir = "/var/www/html/fotobarang/"; // Direktori tempat gambar disimpan
            $fileName = basename($_FILES['gambar']['name']);
            $targetFile = $targetDir . $fileName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Cek apakah file adalah gambar
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Pindahkan file gambar ke direktori tujuan
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                    // Masukkan nama file gambar ke dalam data
                    $data['gambar'] = $fileName;
                } else {
                    echo "Gagal mengupload gambar.";
                    exit();
                }
            } else {
                echo "Hanya file gambar yang diperbolehkan.";
                exit();
            }
        } else {
            echo "Gambar tidak ditemukan.";
            exit();
        }

        if (isset($_SESSION['user']['id'])) {
            $userId = $_SESSION['user']['id'];

            // Panggil fungsi untuk menambahkan barang ke database
            if ($this->addBarang($data, $userId)) {
                header("Location: /tokobekas/app/view/barang_list.php");
                exit();
            } else {
                echo "Gagal menambahkan barang.";
            }
        } else {
            echo "User belum login.";
        }
    }
}


    public function showUserBarang($userId) {
        return $this->barangModel->getBarangByUser($userId);
    }
    // BarangController.php
// BarangController.php
        public function deleteBarang($id) {
            $barangModel = new BarangModel();
            return $barangModel->deleteBarang($id);
        }


}

$barangController = new BarangController();
$barangController->handleRequest();
