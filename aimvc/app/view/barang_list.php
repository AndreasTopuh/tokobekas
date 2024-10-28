<?php
error_reporting(E_ALL & ~E_NOTICE); // Menyembunyikan pesan notice
session_start(); // Pastikan ini dipanggil hanya sekali

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/aimvc/index.php"); // Redirect ke login jika belum login
    exit;
}

require_once '../controller/BarangController.php'; // Memastikan controller bisa diakses

use Controller\BarangController;

$barangController = new BarangController();
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Mendapatkan data pencarian
$barangList = $barangController->showAllBarang(); // Mendapatkan data barang dari controller
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="/tokobekas/aimvc/public/css/style.css">
</head>
<body>
    <h1>Daftar Barang Bekas</h1>
    <a href="dashboarduser.php">Kembali ke Dashboard</a>

    <!-- <form method="GET" action="barang_list.php">
        <input type="text" name="search" placeholder="Cari barang..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Cari</button>
    </form> -->

    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kondisi</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Nomor Penjual</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($barangList): ?>
                <?php foreach ($barangList as $barang): ?>
                    <tr>
                        <td><?= htmlspecialchars($barang['nama']); ?></td>
                        <td><?= htmlspecialchars($barang['harga']); ?></td>
                        <td><?= htmlspecialchars($barang['kondisi']); ?></td>
                        <td><?= htmlspecialchars($barang['jenis']); ?></td>
                        <td><?= htmlspecialchars($barang['status']); ?></td>
                        <td><?= htmlspecialchars($barang['nomor_penjual']); ?></td>
                        <td><?= htmlspecialchars($barang['deskripsi']); ?></td>
                    </tr>
                    
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada barang yang tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
