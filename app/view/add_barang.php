<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /unkpresent/tokobekas/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="/unkpresent/tokobekas/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        /* Additional styles */
        .small-label {
            font-size: 0.8rem; /* Adjust label size as needed */
        }
        .form-control-sm {
            font-size: 0.875rem;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
        .form-control-sm:focus {
            background-color: #ffffff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-bd-primary {
            background-color: #712cf9;
            border-color: #712cf9;
        }
        .btn-bd-primary:hover {
            background-color: #6528e0;
            border-color: #6528e0;
        }
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Barang</h1>
        <br>
                <a href="dashboarduser.php" class="btn btn-secondary mt-3 mb-3">Kembali ke Dashboard</a>
        <form method="POST" action="../controller/BarangController.php" class="shadow-sm p-4 bg-white rounded">
            
            <div class="mb-3">
                <label for="nama" class="form-label small-label">Nama Barang</label>
                <input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Nama Barang" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label small-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control form-control-sm" placeholder="Harga" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="form-label small-label">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-select form-control-sm" required>
                    <option value="baru">Baru</option>
                    <option value="bekas">Bekas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label small-label">Jenis Barang</label>
                <input type="text" name="jenis" id="jenis" class="form-control form-control-sm" placeholder="Jenis Barang">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label small-label">Status</label>
                <select name="status" id="status" class="form-select form-control-sm" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="terjual">Terjual</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nomor_penjual" class="form-label small-label">Nomor Penjual</label>
                <input type="text" name="nomor_penjual" id="nomor_penjual" class="form-control form-control-sm" placeholder="Nomor Penjual" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label small-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi"></textarea>
            </div>
            <button type="submit" name="add_barang" class="btn btn-bd-primary">Tambah Barang</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
