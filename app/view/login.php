<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/tokobekas/public/css/loginsignup.css">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #3b5d50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        /* Container Styles */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 500px;
        }

        /* Card Styles */
        .login-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        /* Image Container */
        .image-container {
            height: 150px;
            background: #3b5d50;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* Form Container */
        .form-container {
            padding: 20px;
            text-align: center;
            color: #333;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #3b5d50;
        }

        /* Input Group */
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
        }

        .input-group input:focus {
            border-color: #3b5d50;
            box-shadow: 0 0 5px rgba(59, 93, 80, 0.5);
        }

        /* Password Toggle */
        .password-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 10px;
            background: #3b5d50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #2f4a43;
        }

        /* Forgot Password */
        .forgot-password {
            margin-top: 15px;
            font-size: 14px;
        }

        .forgot-password a {
            color: #3b5d50;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="image-container">
                <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="background-image">
            </div>
            <div class="form-container">
                <h2>Log in</h2>
                <form method="POST" action="/tokobekas/index.php">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group password-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                    <button type="submit" name="login" class="btn">Continue</button>
                </form>
                <p class="forgot-password"><a href="#">Forgot your password?</a></p>
                
                <!-- Menampilkan pesan error dan sukses -->
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error text-danger"><?= htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <p class="success text-success"><?= htmlspecialchars($_SESSION['success']); ?></p>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <p class="text-center mt-3">Belum punya akun? <a href="/tokobekas/app/view/register.php">Daftar di sini</a>.</p>
            </div>
        </div>
    </div>
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html>
