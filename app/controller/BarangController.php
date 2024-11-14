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
                'deskripsi' => $_POST['deskripsi']
            ];

            // Proses upload gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $targetDir = '/var/www/html/unkpresent/tokobekas/public/img/';
                $fileName = basename($_FILES['gambar']['name']);
                $targetFilePath = $targetDir . $fileName;

                // Move the uploaded file
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
                    $data['gambar'] = $fileName;
                } else {
                    echo "Gagal mengunggah gambar.";
                    exit();
                }
            } else {
                // Default image in case no image is uploaded
                $data['gambar'] = 'default.jpg';
            }

            if (isset($_SESSION['user']['id'])) {
                $userId = $_SESSION['user']['id'];

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

    public function showUserBarang($userId) {
        return $this->barangModel->getBarangByUser($userId);
    }
}

$barangController = new BarangController();
$barangController->handleRequest();
