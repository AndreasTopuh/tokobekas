<?php
namespace Controller;

require_once __DIR__ . '/../model/BarangModel.php'; // Pastikan path ini benar

use Model\BarangModel;

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

    // Fungsi untuk menangani request
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

            // Mengambil dan memproses file gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $_FILES['gambar'];
                $targetDir = '/var/www/html/tokobekas/public/images/fotobarang/';
                
                // Membuat nama unik untuk file gambar
                $fileName = uniqid() . '_' . basename($gambar['name']);
                $targetFilePath = $targetDir . $fileName;

                // Validasi tipe file gambar (misalnya hanya menerima gambar JPG, PNG, JPEG)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (in_array($gambar['type'], $allowedTypes)) {
                    // Memindahkan file ke folder tujuan
                    if (move_uploaded_file($gambar['tmp_name'], $targetFilePath)) {
                        // Menambahkan nama file gambar ke data
                        $data['gambar'] = $fileName;
                    } else {
                        echo "Gagal mengupload gambar.";
                        return;
                    }
                } else {
                    echo "Hanya file gambar yang diperbolehkan (JPG, PNG, JPEG).";
                    return;
                }
            } else {
                echo "Gambar tidak ditemukan atau ada kesalahan saat mengupload.";
                return;
            }

            // Memastikan user sudah login
            if (isset($_SESSION['user']['id'])) {
                $userId = $_SESSION['user']['id'];

                // Menambahkan barang
                if ($this->addBarang($data, $userId)) {
                    header("Location: ../view/barang_list.php");
                    exit();
                } else {
                    echo "Gagal menambahkan barang.";
                }
            } else {
                echo "User belum login.";
            }
        }
    }

    // Fungsi untuk menampilkan barang berdasarkan user
    public function showUserBarang($userId) {
        return $this->barangModel->getBarangByUser($userId);
    }

    // Fungsi untuk menghapus barang
    public function deleteBarang($id) {
        $barangModel = new BarangModel();
        return $barangModel->deleteBarang($id);
    }
}

// Menangani request
$barangController = new BarangController();
$barangController->handleRequest();
