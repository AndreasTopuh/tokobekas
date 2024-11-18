<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE); // Menyembunyikan pesan notice

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/index.php");
    exit();
}

require_once '../controller/BarangController.php';
use Controller\BarangController;

$barangController = new BarangController();
$userId = $_SESSION['user']['id'];
$user = $_SESSION['user'];
$userBarangList = $barangController->showUserBarang($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_barang'])) {
    $barangController->updateBarang($_POST['id'], $_POST['status']);
    header("Location: my_barang.php"); // Refresh halaman setelah update
    exit();
}

// Delete Barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_barang'])) {
    $barangController->deleteBarang($_POST['id']);
    header("Location: my_barang.php"); // Refresh halaman setelah delete
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="./dashboarduser.php">Tokobekas<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li><a class="nav-link" href="./dashboarduser.php">Home</a></li>
                    <li><a class="nav-link" href="./barang_list.php">Daftar Barang Bekas</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_barang.php">Jual Barang Anda</a></li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./my_barang.php">Barang Yang Anda Jual</a>
                    </li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link active" href="./my_barang.php"><img src="/tokobekas/public/images/user.svg" class="img-fluid"></a></li>
                    <li><a class="nav-link" href="./logout.php"><img src="/tokobekas/public/images/logout.png" class="img-fluid"></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header style="background-color: #3b5d50; color: white; padding: 20px 10px;">
        <div class="container">
            <h1 class="fs-4 text-start mb-1">Hi, <strong style="color: yellow;"><?= htmlspecialchars($user['nama']); ?></strong>!</h1>
            <p class="mt-2" style="font-size: 14px; font-weight: 300; color: #ffffff; font-style: italic;">
                Ayoo jadilah berkat untuk orang lain dengan menjual barang bekas anda dengan harga murah
            </p>
        </div>
    </header>

    <!-- Table Barang -->
    <div class="container mt-5">
        <h1 class="text-left mb-4">Barang yang Anda Jual</h1>

        <div class="row">
            <?php if ($userBarangList): ?>
                <?php foreach ($userBarangList as $barang): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body d-flex flex-column">
                             <img src="/fotobarang/<?= htmlspecialchars($barang['gambar']); ?>" class="card-img-top img-fluid custom-img shadow-sm p-2" alt="Gambar Barang"">
                            
                            <h5 class="card-title text-primary"><?= htmlspecialchars($barang['nama']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($barang['jenis']); ?> - <?= htmlspecialchars($barang['kondisi']); ?></h6>
                            <p class="card-text">
                                
                                <strong>Harga:</strong> Rp <?= htmlspecialchars(number_format($barang['harga'], 2, ',', '.')); ?>
                                
                                <br>
                                <strong>Status:</strong> 
                                <span class="badge bg-<?= $barang['status'] === 'tersedia' ? 'success' : 'secondary'; ?>">
                                    <?= htmlspecialchars($barang['status']); ?>
                                </span>
                                <br>
                                <strong>Nomor Penjual:</strong> 
                                <a href="https://wa.me/<?= urlencode($barang['nomor_penjual']); ?>" target="_blank" class="text-decoration-none">
                                    <?= htmlspecialchars($barang['nomor_penjual']); ?>
                                </a><br>
                                <strong>Deskripsi:</strong> <?= htmlspecialchars($barang['deskripsi']); ?>
                            </p>
                            <form method="POST" class="mt-auto">
                                <input type="hidden" name="id" value="<?= $barang['id']; ?>">
                                <select name="status" class="form-select form-select-sm mb-2">
                                    <option value="tersedia" <?= $barang['status'] === 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="terjual" <?= $barang['status'] === 'terjual' ? 'selected' : ''; ?>>Terjual</option>
                                </select>
                                <button type="submit" name="update_barang" class="btn btn-primary btn-sm w-100">Update Status</button>
                                <!-- Tombol Hapus Barang -->
                                <button type="submit" name="delete_barang" class="btn btn-danger btn-sm w-100 mt-2" onclick="return confirm('Anda yakin ingin menghapus barang ini?')">Hapus Barang</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Anda belum menjual barang apapun.</p>
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
                    <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>

            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#" style="font-size: 0.875rem;">About Us</a></li>
                        </ul>
                    </div>
                </div>
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
</body>
</html>
