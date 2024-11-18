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
    }public function handleRequest() {
    session_start();

    if (isset($_POST['add_barang'])) {
        // Data Barang
        $data = [
            'nama' => $_POST['nama'],
            'harga' => $_POST['harga'],
            'kondisi' => $_POST['kondisi'],
            'jenis' => $_POST['jenis'],
            'status' => $_POST['status'],
            'nomor_penjual' => $_POST['nomor_penjual'],
            'deskripsi' => $_POST['deskripsi']
        ];

        // Validasi Gambar
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
            // Cek ukuran file (Max 3MB)
            if ($_FILES['gambar']['size'] > 3 * 1024 * 1024) {
                $_SESSION['error'] = "Ukuran gambar tidak boleh lebih dari 3 MB.";
                header("Location: /tokobekas/app/view/add_barang.php");
                exit();
            }

            // Proses Kompresi Gambar
            $imageInfo = getimagesize($_FILES['gambar']['tmp_name']);
            $imageType = $imageInfo[2];
            $uploadDir = "/var/www/html/fotobarang/";
            $imageName = uniqid('gambar_', true) . '.' . pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $imagePath = $uploadDir . $imageName;

            // Kompresi dan simpan gambar berdasarkan tipe
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($_FILES['gambar']['tmp_name']);
                    imagejpeg($source, $imagePath, 75); // Kompresi gambar JPG dengan kualitas 75
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($_FILES['gambar']['tmp_name']);
                    imagepng($source, $imagePath, 6); // Kompresi gambar PNG dengan level kompresi 6
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($_FILES['gambar']['tmp_name']);
                    imagegif($source, $imagePath); // Tidak ada kualitas kompresi pada GIF
                    break;
                default:
                    $_SESSION['error'] = "Format gambar tidak didukung.";
                    header("Location: /tokobekas/app/view/add_barang.php");
                    exit();
            }

            // Pastikan gambar berhasil disimpan
            if (!file_exists($imagePath)) {
                $_SESSION['error'] = "Gagal mengupload gambar.";
                header("Location: /tokobekas/app/view/add_barang.php");
                exit();
            }

            // Masukkan nama gambar ke dalam data barang
            $data['gambar'] = $imageName;
        } else {
            $_SESSION['error'] = "Gambar tidak ditemukan.";
            header("Location: /tokobekas/app/view/add_barang.php");
            exit();
        }

        // Pastikan user sudah login
        if (isset($_SESSION['user']['id'])) {
            $userId = $_SESSION['user']['id'];

            // Panggil fungsi untuk menambah barang ke database
            if ($this->addBarang($data, $userId)) {
                header("Location: /tokobekas/app/view/barang_list.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menambahkan barang.";
                header("Location: /tokobekas/app/view/add_barang.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "User belum login.";
            header("Location: /tokobekas/app/view/login.php");
            exit();
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
