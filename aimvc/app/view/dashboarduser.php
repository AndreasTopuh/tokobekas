<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/aimvc/index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/tokobekas/aimvc/public/css/style.css">
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user['nama']); ?>!</h1>
    <p>Email: <?= htmlspecialchars($user['email']); ?></p>
    <a href="./add_barang.php">Tambah Barang</a>
    <br>
    <a href="./barang_list.php">Lihat Daftar barang-barang yang di jual</a>
    <br>
    <a href="./my_barang.php">Lihat Barang yang Anda Jual</a>

    <form method="POST" action="../view/logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
