<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /unkpresent/tokobekas/index.php");
    exit;
}

require_once '../controller/BarangController.php';

use Controller\BarangController;

$barangController = new BarangController();
$barangList = $barangController->showAllBarang();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Bekas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/unkpresent/tokobekas/public/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Barang Bekas</h1>
        <a href="dashboarduser.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <div class="row">
            <?php if ($barangList): ?>
                <?php foreach ($barangList as $barang): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($barang['nama']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary"><?= htmlspecialchars($barang['jenis']); ?> - <?= htmlspecialchars($barang['kondisi']); ?></h6>
                                <p class="card-text">
                                    Harga: Rp <?= htmlspecialchars($barang['harga']); ?><br>
                                    Status: <?= htmlspecialchars($barang['status']); ?><br>
                                    Nomor Penjual: <?= htmlspecialchars($barang['nomor_penjual']); ?><br>
                                    Deskripsi: <?= htmlspecialchars($barang['deskripsi']); ?>
                                </p>
                                <a href="#" class="card-link">Lihat Detail</a>
                                <a href="#" class="card-link">Hubungi Penjual</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada barang yang tersedia</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
