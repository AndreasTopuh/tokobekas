<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fafafa;
        }
        .register-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .error, .success {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container mt-5">
        <div class="logo">
            <h1>Logo</h1> <!-- Ganti dengan logo Anda -->
        </div>
        <h2 class="text-center">Daftar</h2>
<form method="POST" action="/tokobekas/"> <!-- Ganti dengan URL yang benar -->
            <div class="mb-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
        </form>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error text-danger"><?= htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="success text-success"><?= htmlspecialchars($_SESSION['success']); ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <p class="text-center mt-3">Sudah punya akun? <a href="./app/view/login.php">Login di sini</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
