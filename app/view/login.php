<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    <link rel="stylesheet" href="/tokobekas/public/css/loginsignup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="login-wrapper d-flex align-items-center justify-content-center vh-100">
        <div class="login-box">
            <!-- Logo -->
            <div class="text-center">
                <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="logo-img mb-3">
            </div>

            <!-- Title -->
            <h1 class="text-center mb-4">Welcome Back!</h1>
            <p class="text-center text-muted">Log in to your account</p>

            <!-- Login Form -->
            <form method="POST" action="/tokobekas/index.php">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                </div>
                <div class="form-group mb-3 password-field">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                    <i class="fa fa-eye eye-icon" onclick="togglePassword()"></i>
                </div>

                <!-- Error/Success Messages -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']); ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['success']); ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <!-- Buttons -->
                <button type="submit" name="login" class="btn btn-lg btn-primary w-100 mb-3">Log In</button>
                <p class="text-center">
                    Don't have an account? <a href="/tokobekas/app/view/register.php">Sign Up</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>
