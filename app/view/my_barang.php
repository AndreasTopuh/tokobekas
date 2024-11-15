<?php
error_reporting(E_ALL & ~E_NOTICE); // Menyembunyikan pesan notice
session_start(); // Pastikan ini dipanggil hanya sekali

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/index.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang yang Anda Jual</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Barang yang Anda Jual</h1>
        <a href="dashboarduser.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <table class="table table-striped table-bordered">
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
                            <td>Rp <?= htmlspecialchars(number_format($barang['harga'], 2, ',', '.')); ?></td>
                            <td><?= htmlspecialchars($barang['kondisi']); ?></td>
                            <td><?= htmlspecialchars($barang['jenis']); ?></td>
                            <td><?= htmlspecialchars($barang['status']); ?></td>
                            <td><?= htmlspecialchars($barang['nomor_penjual']); ?></td>
                            <td><?= htmlspecialchars($barang['deskripsi']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="tersedia" <?= $barang['status'] === 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                        <option value="terjual" <?= $barang['status'] === 'terjual' ? 'selected' : ''; ?>>Terjual</option>
                                    </select>
                                    <button type="submit" name="update_barang" class="btn btn-primary btn-sm mt-1">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Anda belum menjual barang apapun.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
