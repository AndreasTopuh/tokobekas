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
            $fileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $_FILES['gambar']['name']); // Normalisasi nama file
            $targetFile = $targetDir . $fileName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/heic'];
            $fileMimeType = mime_content_type($_FILES['gambar']['tmp_name']);

            // Validasi tipe file berdasarkan ekstensi dan MIME
            if ((in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'heic'])) && 
                (in_array($fileMimeType, $allowedMimeTypes))) {
                if ($_FILES['gambar']['size'] <= 10 * 1024 * 1024) { // Maksimal 10MB
                    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                        $data['gambar'] = $fileName;
                    } else {
                        echo "Gagal mengupload gambar.";
                        exit();
                    }
                } else {
                    echo "Ukuran file terlalu besar.";
                    exit();
                }
            } else {
                echo "Hanya file gambar yang diperbolehkan.";
                exit();
            }
        } else {
            echo "Gambar tidak ditemukan atau terjadi error.";
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
