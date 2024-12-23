<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/loginsignup.css">

</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100 p-4">
            <div class="col-lg-6 col-md-8 col-sm-10 login-container">
                <!-- Logo Toko Bekas -->
                <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="img-fluid mb-4" style="max-width: 150px; display: block; margin: 0 auto;">
                
                <!-- Judul Halaman Login -->
                <h2 class="text-center mb-4">Login</h2>

                <!-- Form Login -->
                <form method="POST" action="/tokobekas/index.php">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required id="password">
                    </div>

                    <!-- Show Password Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" onclick="lihatPassword()" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>

                    <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                </form>

                <!-- Menampilkan pesan error dan sukses -->
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error text-danger"><?= htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <p class="success text-success"><?= htmlspecialchars($_SESSION['success']); ?></p>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <!-- Link untuk halaman register jika belum punya akun -->
                <p class="text-center mt-3">Jika Anda belum terdaftar, silakan <a href="/tokobekas/app/view/register.php">daftar di sini</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk toggle password visibility
        function lihatPassword() {
            var x = document.getElementById("password");
            var showPasswordCheckbox = document.getElementById("showPassword");

            // Toggle password visibility
            if (showPasswordCheckbox.checked) {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
