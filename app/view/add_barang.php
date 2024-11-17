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
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/style.css">
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
                    <li class="nav-item active"><a class="nav-link" href="./add_barang.php">Jual Barang Anda</a></li>
                    <li class="nav-item"><a class="nav-link" href="./my_barang.php">Barang Yang Anda Jual</a></li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="./my_barang.php"><img src="/tokobekas/public/images/user.svg" class="img-fluid"></a></li>
                    <li><a class="nav-link" href="logout.php"><img src="/tokobekas/public/images/logout.png" class="img-fluid"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Welcome Message -->
    <header style="background-color: #3b5d50; color: white; padding: 20px 10px;">
        <div class="container">
            <h1 class="fs-4 text-start mb-1">Hi, <strong style="color: yellow;"><?= htmlspecialchars($user['nama']); ?></strong>!</h1>
            <p class="mt-2" style="font-size: 14px; font-weight: 300; color: #ffffff; font-style: italic;">
                Ayoo jadilah berkat untuk orang lain dengan menjual barang bekas anda dengan harga murah
            </p>
        </div>
    </header>

    <!-- Form Tambah Barang -->
    <div class="container mt-5">
        <h2 class="text-left mb-4">Tambah Barang Bekas Anda</h2>
        <form method="POST" action="../controller/BarangController.php" class="shadow-lg text-sm p-4 bg-white rounded" enctype="multipart/form-data" onsubmit="cleanRupiah()">
            <div class="mb-3 shadow-lg">
                <label for="nama" class="form-label"><strong>Nama Barang</strong></label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="cth Laptop Axio" required>
            </div>
            <div class="mb-3 shadow-lg">
                <label for="gambar" class="form-label"><strong>Gambar Barang</strong></label>
                <input type="file" name="gambar" id="gambar" class="form-control" required>
            </div>

            <div class="mb-3 shadow-lg">
                <label for="harga" class="form-label"><strong>Harga</strong> </label>
                <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan harga" oninput="formatRupiah(this)" required>
            </div>

            <div class="mb-3 shadow-lg">
                <label for="kondisi" class="form-label"><strong>Kondisi</strong></label>
                <select name="kondisi" id="kondisi" class="form-select" required>
                    <option value="bekas">Bekas</option>
                    <option value="baru">Baru</option>
                </select>
            </div>
            
            <div class="mb-3 shadow-lg">
                <label for="jenis" class="form-label"><strong>Jenis Barang</strong></label>
                <select name="jenis" id="jenis" class="form-select" placeholder="Jenis Barang">
                    <option value="">Pilih Jenis Barang</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Furnitur">Furnitur</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Sepatu">Sepatu</option>
                    <option value="Tas">Tas</option>
                    <option value="Peralatan Rumah Tangga">Peralatan Rumah Tangga</option>
                    <option value="Mainan">Mainan</option>
                    <option value="Buku">Buku</option>
                    <option value="Kendaraan">Kendaraan</option>
                    <option value="Alat Olahraga">Alat Olahraga</option>
                    <option value="Komputer & Aksesoris">Komputer & Aksesoris</option>
                    <option value="Peralatan Dapur">Peralatan Dapur</option>
                    <option value="Alat Musik">Alat Musik</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3 shadow-lg">
                <label for="status" class="form-label"><strong>Status</strong></label>
                <select name="status" id="status" class="form-select" required>
                    <option value="tersedia">Tersedia</option>
                </select>
            </div>

            <div class="mb-3 shadow-lg">
                <label for="nomor_penjual" class="form-label"><strong>Nomor Penjual</strong></label>
                <input type="text" name="nomor_penjual" id="nomor_penjual" class="form-control" placeholder="cht 0857********" required>
            </div>

            <div class="mb-3 shadow-lg">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsikan kekurangan barang anda" rows="4" maxlength="auto"></textarea>
            </div>

            <button type="submit" name="add_barang" class="btn btn-primary btn-sm">Tambah Barang</button>
        </form>
    </div>

    <!-- Footer -->
	<footer class="footer-section">
		<div class="container relative">

	



			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Tokobekas<span>.</span></a></div>
					<p class="mb-4">Dengan Tokobekas, Anda bisa menjual barang bekas yang tidak terpakai dan mendapatkan uang tambahan. Platform kami menghubungkan Anda langsung dengan pembeli tanpa perantara. Jual beli barang bekas kini jadi lebih mudah dan aman</p>

					<ul class="list-unstyled custom-social">
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
				
								<li><a href="#">About Us</a></li>
			
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">About Us</a></li>
			
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">About Us</a></li>
						
							</ul>
						</div>


					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;
							<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
							Develop by <a>Andreas Jeno Figo Topuh dkk</a> 
					
						</p>
					</div>



				</div>
			</div>

		</div>
	</footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk memformat harga menjadi format Rupiah
        function formatRupiah(input) {
            let value = input.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = 'Rp ' + rupiah;
        }

        // Fungsi untuk membersihkan format Rupiah sebelum form disubmit
        function cleanRupiah() {
            let hargaInput = document.getElementById('harga');
            let value = hargaInput.value.replace(/[^0-9]/g, ''); // Menghapus simbol 'Rp' dan titik
            hargaInput.value = value; // Mengembalikan input ke nilai mentah tanpa format
        }
    </script>
</body>
</html>
