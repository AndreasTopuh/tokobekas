<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #3b5d50;
        }
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-form-container {
            padding: 20px;
        }
        .hero-img-wrap img {
            max-width: 100%;
            height: auto;
        }
        .error, .success {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid ">
    <div class="row justify-content-center align-items-center vh-100 p-4">
        <!-- Form Login Kolom Kiri -->
        <div class="col-lg-6 col-md-8 col-sm-10 login-container">
            <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="img-fluid mb-4" style="max-width: 150px; display: block; margin: 0 auto;">

           <!-- Logo atau Judul -->
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="/tokobekas/index.php">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn btn-success w-100">Login</button>
            </form>

            <?php if (isset($_SESSION['error'])): ?>
                <p class="error text-danger"><?= htmlspecialchars($_SESSION['error']); ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <p class="success text-success"><?= htmlspecialchars($_SESSION['success']); ?></p>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <p class="text-center mt-3">Jika Anda belum terdaftar, silakan <a href="/tokobekas/app/view/register.php">daftar di sini</a>.</p>
        </div>
        
        <!-- Gambar Kolom Kanan -->

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
