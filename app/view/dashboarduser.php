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
	 <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/style.css">
    <link rel="stylesheet" href="/tokobekas/public/css/tiny-slider.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



</head>

<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="./dashboarduser.php">Tokobekas<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="./dashboarduser.php">Home</a>
                    </li>
					    <li><a class="nav-link" href="barang_list.php">Daftar Barang Bekas</a></li>
                    <li><a class="nav-link" href="./add_barang.php">Jual Barang Anda</a></li>
					<li class="nav-item">
                        <a class="nav-link" href="./my_barang.php">Barang Yang Anda Jual</a>
                    </li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="./my_barang.php"><img src="/tokobekas/public/images/user.svg" class="img-fluid"></a></li>
                    <li><a class="nav-link" href="../view/logout.php"><img src="/tokobekas/public/images/logout.png" class="img-fluid"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Barang Bekas Terbaik Dengan Harga Terjangkau</h2></h1>
						<p class="mb-4">Kami menyediakan berbagai macam barang bekas berkualitas dengan harga yang lebih hemat. Temukan barang impian Anda sekarang!</p>
						<p><a href="barang_list.php" class="btn btn-secondary me-2">Lihat Barang</a></p>
					</div>
				</div>
<div class="col-lg-7 col-md-4">
    <!-- <div class="hero-img-wrap">
        <img src="/tokobekas/public/images/gambar_brg_bekass.png" class="img-fluid">
    </div> -->
</div>

			</div>
		</div>
	</div>
    <!-- End Hero Section -->

	<!-- Start Product Carousel -->
	<div class="testimonial-slider">

                        <!-- Testimonial 1 - Andreas Jeno Figo Topuh -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <!-- <blockquote class="mb-5">
                                            <p>&ldquo;Tokobekas has truly transformed how we see the second-hand market. 
                                                The ease of use and security of the platform have allowed us to 
                                                build a reliable community of buyers and sellers. Our goal is to 
                                                continue improving and provide a seamless experience for everyone.&rdquo;</p>
                                        </blockquote> -->

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/laptopbekas.jpg" alt="img1" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Laptop Bekas</h3>
                                            <span class="position d-block mb-3">Rp. 2.500.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 1 -->

                        <!-- Testimonial 2 - Rey Wongkaren -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <!-- <blockquote class="mb-5">
                                            <p>&ldquo;Working with the Tokobekas team has been an incredible experience. 
                                                The platform's development has come a long way, and I'm excited 
                                                for what's to come. We continuously strive to enhance the user 
                                                experience, making buying and selling used items simple and secure.&rdquo;</p>
                                        </blockquote> -->

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/jam_ex.png" alt="img2" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Jam Bekas</h3>
                                            <span class="position d-block mb-3">Rp. 250.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 2 -->

                        <!-- Testimonial 3 - Jerico -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <!-- <blockquote class="mb-5">
                                            <p>&ldquo;I've been a part of Tokobekas since the very beginning, and seeing how 
                                                it has evolved has been nothing short of amazing. The platform has 
                                                become a reliable space for people to safely buy and sell used goods, 
                                                and it's great to be part of such an impactful project.&rdquo;</p>
                                        </blockquote> -->

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/iphone12_ex.png" alt="img3" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Iphone 12</h3>
                                            <span class="position d-block mb-3">Rp. 17.000.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 3 -->

                    </div>



	<!-- End Product Carousel -->


    <!-- Start Product Section -->
	<div class="product-section">
		<div class="container">
			<div class="row">

				<!-- Start Column 1 -->
				<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
					<h2 class="mb-4 section-title">Barang Bekas Terbaik Dengan Harga Terjangkau</h2>
					<p class="mb-4">Dapatkan berbagai barang bekas berkualitas yang masih layak pakai dengan harga jauh lebih murah. Barang berkualitas, harga bersahabat!</p>
					<p><a href="barang_list.php" class="btn">Jelajahi</a></p>
				</div>
				<!-- End Column 1 -->

				<!-- Start Column 2 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" >
						<img src="/tokobekas/public/images/topi_ex.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Topi Polo</h3>
						<strong class="product-price">Rp 80.000</strong>


					</a>
				</div>
				<!-- End Column 2 -->

				<!-- Start Column 3 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" >
						<img src="/tokobekas/public/images/jam_ex.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Jam Casio</h3>
						<strong class="product-price">Rp 150.000</strong>

					</a>
				</div>
				<!-- End Column 3 -->

				<!-- Start Column 4 -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
					<a class="product-item" >
						<img src="/tokobekas/public/images/iphone12_ex.png" class="img-fluid product-thumbnail">
						<h3 class="product-title">Iphone 13</h3>
						<strong class="product-price">Rp 6.000.000</strong>


					</a>
				</div>
				<!-- End Column 4 -->

			</div>
		</div>
	</div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
	<div class="why-choose-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-6">
					<h2 class="mb-4">Kenapa Memilih Tokobekas?</h2>
					<p>Temukan barang bekas berkualitas dengan harga yang sangat terjangkau di Tokobekas. Belanja lebih hemat, barang lebih bermanfaat!</p>

				<div class="row my-5">
					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="/tokobekas/public/images/truck.svg" alt="Image" class="img-fluid">
							</div>
							<h3>Tempat Bertemu Penjual & Pembeli</h3>
							<p>Tokobekas berfungsi sebagai platform komunikasi yang menghubungkan penjual dan pembeli barang bekas, memungkinkan negosiasi langsung dan transaksi aman.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="/tokobekas/public/images/bag.svg" alt="Image" class="img-fluid">
							</div>
							<h3>Mudah untuk Bertransaksi</h3>
							<p>Cukup daftar, unggah produk Anda, dan Anda siap untuk terhubung langsung dengan pembeli. Transaksi lebih cepat dan mudah tanpa perantara.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="/tokobekas/public/images/support.svg" alt="Image" class="img-fluid">
							</div>
							<h3>Dukungan untuk Komunikasi Langsung</h3>
							<p>Kami menyediakan fitur chat yang memudahkan komunikasi antara penjual dan pembeli untuk menjelaskan detil produk atau menegosiasikan harga.</p>
						</div>
					</div>

					<div class="col-6 col-md-6">
						<div class="feature">
							<div class="icon">
								<img src="/tokobekas/public/images/return.svg" alt="Image" class="img-fluid">
							</div>
							<h3>Transaksi Tanpa Ribet</h3>
							<p>Platform kami memastikan transaksi berjalan lancar dengan memberi ruang bagi penjual dan pembeli untuk menyelesaikan kesepakatan dengan mudah, tanpa ada biaya tambahan.</p>
						</div>
					</div>
				</div>

				</div>

				<div class="col-lg-5">
					<div class="img-wrap">
						<img src="/tokobekas/public/images/bekas2.png" alt="Image" class="img-fluid">
					</div>
				</div>

			</div>
		</div>
	</div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
	<div class="we-help-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-7 mb-5 mb-lg-0">
					<div class="imgs-grid">
						<div class="grid grid-1"><img src="/tokobekas/public/images/bekas3.jpg" alt="Untree.co"></div>
						<div class="grid grid-2"><img src="/tokobekas/public/images/bekas2.png" alt="Untree.co"></div>
						<div class="grid grid-3"><img src="/tokobekas/public/images/laptopbekas.jpg" alt="Untree.co"></div>
					</div>
				</div>
				<div class="col-lg-5 ps-lg-5">
					<h2 class="section-title mb-4">Kami Membantu Anda Menjual Barang Bekas dengan Mudah</h2>
					<p>Dengan Tokobekas, Anda bisa menjual barang bekas yang tidak terpakai dan mendapatkan uang tambahan. Platform kami menghubungkan Anda langsung dengan pembeli tanpa perantara. Jual beli barang bekas kini jadi lebih mudah dan aman.</p>

					<ul class="list-unstyled custom-list my-4">
						<li>Tempat bertemu antara penjual dan pembeli barang bekas</li>
						<li>Proses jual beli yang mudah, tanpa perantara</li>
						<li>Fitur komunikasi langsung antara penjual dan pembeli</li>
						<li>Terhubung langsung dengan WhatsApp untuk negosiasi dan transaksi</li>
					</ul>
					<p><a href="barang_list.php" class="btn">Jelajahi Sekarang</a></p>
				</div>
			</div>
		</div>
	</div>
    <!-- End We Help Section -->

    <!-- Start Popular Section -->
	<div class="popular-product">
<div class="container">
    <div class="row">

        <!-- Start Product 1 (Topi Polo) -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="product-item-sm d-flex">
                <div class="thumbnail">
                    <img src="/tokobekas/public/images/topi_ex.png" alt="Topi Polo" class="img-fluid">
                </div>
                <div class="pt-3">
                    <h3>Topi Polo</h3>
                    <p>Topi berkualitas yang masih layak pakai dengan desain klasik. Bisa dipakai untuk berbagai acara.</p>
                </div>
            </div>
        </div>
        <!-- End Product 1 -->

        <!-- Start Product 2 (Sepatu Nike) -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="product-item-sm d-flex">
                <div class="thumbnail">
                    <img src="/tokobekas/public/images/sepatu_ex.png" alt="Sepatu Nike" class="img-fluid">
                </div>
                <div class="pt-3">
                    <h3>Sepatu Nike</h3>
                    <p>Sepatu olahraga Nike yang masih dalam kondisi sangat baik. Kenyamanan dan performa maksimal!</p>
                </div>
            </div>
        </div>
        <!-- End Product 2 -->

        <!-- Start Product 3 (Jam Casio) -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="product-item-sm d-flex">
                <div class="thumbnail">
                    <img src="/tokobekas/public/images/jam_ex.png" alt="Jam Casio" class="img-fluid">
                </div>
                <div class="pt-3">
                    <h3>Jam Casio</h3>
                    <p>Jam tangan Casio yang tahan lama dan cocok untuk penggunaan sehari-hari. Masih berfungsi dengan baik.</p>
                </div>
            </div>
        </div>
        <!-- End Product 3 -->

    </div>
</div>

	</div>
    <!-- End Popular Section -->

    <!-- Start Testimonial Section -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">

                        <!-- Testimonial 1 - Andreas Jeno Figo Topuh -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Tokobekas has truly transformed how we see the second-hand market. 
                                                The ease of use and security of the platform have allowed us to 
                                                build a reliable community of buyers and sellers. Our goal is to 
                                                continue improving and provide a seamless experience for everyone.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/andreasCTO.jpeg" alt="Andreas Jeno Figo Topuh" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Andreas Jeno Figo Topuh</h3>
                                            <span class="position d-block mb-3">CEO & CTO, Tokobekas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 1 -->

                        <!-- Testimonial 2 - Rey Wongkaren -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Working with the Tokobekas team has been an incredible experience. 
                                                The platform's development has come a long way, and I'm excited 
                                                for what's to come. We continuously strive to enhance the user 
                                                experience, making buying and selling used items simple and secure.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/reydev.jpeg" alt="Rey Wongkaren" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Rey Wongkaren</h3>
                                            <span class="position d-block mb-3">Developer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 2 -->

                        <!-- Testimonial 3 - Jerico -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">
                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;I've been a part of Tokobekas since the very beginning, and seeing how 
                                                it has evolved has been nothing short of amazing. The platform has 
                                                become a reliable space for people to safely buy and sell used goods, 
                                                and it's great to be part of such an impactful project.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="/tokobekas/public/images/JerricoW.jpeg" alt="Jerico" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Jerico</h3>
                                            <span class="position d-block mb-3">Developer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Testimonial 3 -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    <!-- End Testimonial Section -->

    <!-- Start Footer -->
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
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    	<script src="/tokobekas/public/js/bootstrap.bundle.min.js"></script>
	<script src="/tokobekas/public/js/tiny-slider.js"></script>
	<script src="/tokobekas/public/js/custom.js"></script>
</body>

</html>
