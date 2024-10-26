<?php
error_reporting(E_ALL & ~E_NOTICE); // Menyembunyikan pesan notice
session_start(); // Pastikan ini dipanggil hanya sekali

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/aimvc/index.php");
    exit();
}

require_once '../controller/BarangController.php';

use Controller\BarangController;

$barangController = new BarangController();
$userId = $_SESSION['user']['id'];
$userBarangList = $barangController->showUserBarang($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_barang'])) {
    $barangController->updateBarang($_POST['id'], $_POST['status']);
    header("Location: my_barang.php"); // Refresh halaman setelah update
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang yang Anda Jual</title>
    <link rel="stylesheet" href="/tokobekas/aimvc/public/css/style.css">
</head>
<body>
    <h1>Barang yang Anda Jual</h1>
    <a href="dashboarduser.php">Kembali ke Dashboard</a>

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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($userBarangList): ?>
                <?php foreach ($userBarangList as $barang): ?>
                    <tr>
                        <td><?= htmlspecialchars($barang['nama']); ?></td>
                        <td><?= htmlspecialchars($barang['harga']); ?></td>
                        <td><?= htmlspecialchars($barang['kondisi']); ?></td>
                        <td><?= htmlspecialchars($barang['jenis']); ?></td>
                        <td><?= htmlspecialchars($barang['status']); ?></td>
                        <td><?= htmlspecialchars($barang['nomor_penjual']); ?></td>
                        <td><?= htmlspecialchars($barang['deskripsi']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                                <select name="status">
                                    <option value="tersedia" <?= $barang['status'] === 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="terjual" <?= $barang['status'] === 'terjual' ? 'selected' : ''; ?>>Terjual</option>
                                </select>
                                <button type="submit" name="update_barang">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Anda belum menjual barang apapun.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
