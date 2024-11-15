<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .welcome-message {
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center welcome-message">Welcome, <?= htmlspecialchars($user['nama']); ?>!</h1>
        <p class="text-center">Email: <?= htmlspecialchars($user['email']); ?></p>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Barang</h5>
                        <p class="card-text">Tambahkan barang baru yang ingin Anda jual.</p>
                        <a href="./add_barang.php" class="btn btn-custom">Tambah Barang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Barang</h5>
                        <p class="card-text">Lihat semua barang yang tersedia untuk dijual.</p>
                        <a href="./barang_list.php" class="btn btn-custom">Lihat Daftar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Barang yang Anda Jual</h5>
                        <p class="card-text">Kelola barang-barang yang telah Anda jual.</p>
                        <a href="./my_barang.php" class="btn btn-custom">Lihat Barang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <form method="POST" action="../view/logout.php" class="mt-4">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
