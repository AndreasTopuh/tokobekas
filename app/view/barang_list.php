<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/index.php");
    exit;
}

require_once '../controller/BarangController.php';

use Controller\BarangController;

$barangController = new BarangController();
$barangList = $barangController->handleRequest();  // Menggunakan handleRequest() untuk menangani filter jenis

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/style.css">
    <link rel="stylesheet" href="/tokobekas/public/css/tiny-slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="./dashboarduser.php">Jerrico Jhenkins<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li>
                        <a class="nav-link" href="./dashboarduser.php">Home</a>
                    </li>
                    <li class="nav-item active"><a class="nav-link" href="./barang_list.php">Daftar Barang Bekas</a></li>
                    <li><a class="nav-link" href="add_barang.php">Jual Barang Anda</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="./my_barang.php">Barang Yang Anda Jual</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="./my_barang.php"><img src="/tokobekas/public/images/user.svg" class="img-fluid"></a></li>
                    <li><a class="nav-link" href="./logout.php"><img src="/tokobekas/public/images/logout.png" class="img-fluid"></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-left mb-4">Daftar Barang Bekas</h2>

        <!-- Filter berdasarkan jenis -->
        <form method="get" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="jenis">
                        <option value="">Pilih Jenis Barang</option>
                        <option value="Elektronik" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                        <option value="Furnitur" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Furnitur' ? 'selected' : '' ?>>Furnitur</option>
                        <option value="Pakaian" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Pakaian' ? 'selected' : '' ?>>Pakaian</option>
                        <option value="Sepatu" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Sepatu' ? 'selected' : '' ?>>Sepatu</option>
                        <option value="Tas" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Tas' ? 'selected' : '' ?>>Tas</option>
                        <option value="Peralatan Rumah Tangga" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Peralatan Rumah Tangga' ? 'selected' : '' ?>>Peralatan Rumah Tangga</option>
                        <option value="Mainan" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Mainan' ? 'selected' : '' ?>>Mainan</option>
                        <option value="Buku" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Buku' ? 'selected' : '' ?>>Buku</option>
                        <option value="Kendaraan" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Kendaraan' ? 'selected' : '' ?>>Kendaraan</option>
                        <option value="Alat Olahraga" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Alat Olahraga' ? 'selected' : '' ?>>Alat Olahraga</option>
                        <option value="Komputer & Aksesoris" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Komputer & Aksesoris' ? 'selected' : '' ?>>Komputer & Aksesoris</option>
                        <option value="Peralatan Dapur" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Peralatan Dapur' ? 'selected' : '' ?>>Peralatan Dapur</option>
                        <option value="Alat Musik" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Alat Musik' ? 'selected' : '' ?>>Alat Musik</option>
                        <option value="Lainnya" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center mt-2">
                    <button type="submit" class="btn btn-primary me-2 ">Cari</button>
                    <a href="barang_list.php" class="btn btn-primary me-2">Tampilkan Semua Barang</a>
                </div>
            </div>
        </form>


 

        <div class="row">
            <?php if ($barangList): ?>
                <?php foreach ($barangList as $barang): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card" style="width: 100%;">
                            <img src="/fotobarang/<?= htmlspecialchars($barang['gambar']); ?>" class="card-img-top img-fluid custom-img shadow-sm" alt="Gambar Barang">
                            <div class="card-body shadow-md">
                                <h5 class="card-title"><?= htmlspecialchars($barang['nama']); ?></h5>
                                <h6 class="card-subtitle text-body-secondary "><?= htmlspecialchars($barang['jenis']); ?> - <?= htmlspecialchars($barang['kondisi']); ?></h6>
                                <p class="card-text">
                                    <strong>Harga:</strong> <span class="badge bg-dark">Rp <?= htmlspecialchars(number_format($barang['harga'], 2, ',', '.')); ?></span>
                                    <strong>Status:</strong> <span class="badge bg-<?= $barang['status'] === 'tersedia' ? 'success' : 'danger'; ?>"><?= htmlspecialchars($barang['status']); ?></span>
                                    <br>
                                    <strong>Nomor Penjual:</strong> <a href="https://wa.me/<?= urlencode($barang['nomor_penjual']); ?>" target="_blank" class="text-decoration-none"><?= htmlspecialchars($barang['nomor_penjual']); ?></a><br>
                                    <strong>Deskripsi:</strong> <?= htmlspecialchars($barang['deskripsi']); ?>
                                </p>
                                <a href="https://wa.me/<?= urlencode($barang['nomor_penjual']); ?>?text=Halo,%20saya%20tertarik%20dengan%20barang%20Anda:%20<?= urlencode($barang['nama']); ?>" class="btn btn-primary btn-sm d-flex align-items-center btn-small" target="_blank">
                                    
                                <i class="fab fa-whatsapp me-2"></i> Hubungi Penjual
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada barang yang tersedia</p>
            <?php endif; ?>
        </div>
    </div>

<footer class="footer-section">
    <div class="container relative">
        <div class="row g-3"> <!-- Mengurangi jarak antar kolom -->
            <div class="col-lg-4">
                <div class="mb-2 footer-logo-wrap"> <!-- Mengurangi margin bawah -->
                    <a href="#" class="footer-logo" style="font-size: 1rem;">Tokobekas<span>.</span></a>
                </div>
                <p class="mb-1" style="font-size: 0.6rem;"> <!-- Mengurangi ukuran font pada teks -->
                    Dengan Tokobekas, Anda bisa menjual barang bekas yang tidak terpakai dan mendapatkan uang tambahan. Platform kami menghubungkan Anda langsung dengan pembeli tanpa perantara. Jual beli barang bekas kini jadi lebih mudah dan aman.
                </p>
                <ul class="list-unstyled custom-social" style="font-size: 0.8rem;"> <!-- Mengurangi ukuran font pada ikon -->
                    <!-- <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li> -->
                    <!-- <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li> -->
                    <li><a href="https://www.instagram.com/andreasjft_?igsh=MXFudGZoMWpxdHA3aw%3D%3D&utm_source=qr" target="_blank"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <!-- <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li> -->
                </ul>
            </div>

        </div>

        <div class="border-top copyright">
            <div class="row> <!-- Mengurangi padding atas -->
                <div class="col-lg-6">
                    <p class="mb-1 text-center text-lg-start" style="font-size: 0.75rem;"> <!-- Mengurangi ukuran font -->
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
                        Developed by <a>Andreas Jeno Figo Topuh dkk</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/tokobekas/public/js/bootstrap.bundle.min.js"></script>
    <script src="/tokobekas/public/js/tiny-slider.js"></script>
    <script src="/tokobekas/public/js/custom.js"></script>
</body>
</html>
