<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /tokobekas/aimvc/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="/tokobekas/aimvc/public/css/style.css">
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="POST" action="../controller/BarangController.php">
        <input type="text" name="nama" placeholder="Nama Barang" required>
        <input type="number" name="harga" placeholder="Harga" step="0.01" required>
        <select name="kondisi" required>
            <option value="baru">Baru</option>
            <option value="bekas">Bekas</option>
        </select>
        <input type="text" name="jenis" placeholder="Jenis Barang">
        <select name="status" required>
            <option value="tersedia">Tersedia</option>
            <option value="terjual">Terjual</option>
        </select>
        <input type="text" name="nomor_penjual" placeholder="Nomor Penjual" required>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
        <button type="submit" name="add_barang">Tambah Barang</button>
    </form>
    <a href="dashboarduser.php">Kembali ke Dashboard</a>
</body>
</html>
