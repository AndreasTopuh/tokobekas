<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #3b5d50; /* Sesuaikan background dengan Login */
        }
        .register-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .error, .success {
            text-align: center;
            margin-top: 10px;
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .form-control.is-valid {
            border-color: #28a745;
            background-image: none; /* Menghilangkan ikon centang hijau */
        }
        .invalid-feedback {
            display: block;
        }
        .password-field {
            position: relative;
        }
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100 p-4">
            <div class="col-lg-6 col-md-8 col-sm-10 register-container">
                <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="img-fluid mb-4" style="max-width: 150px; display: block; margin: 0 auto;">
                
                <!-- Register Title -->
                <h2 class="text-center mb-4">Daftar</h2>
                
                <form method="POST" action="/tokobekas/" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        <div id="emailError" class="invalid-feedback" style="display: none;">Email harus menggunakan @gmail.com</div>
                    </div>
                    <div class="mb-3 password-field">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <span class="eye-icon" onclick="lihatPassword()">👁️</span>
                        <div id="passwordError" class="invalid-feedback" style="display: none;">Password harus memiliki minimal 5 karakter dan mengandung setidaknya satu angka.</div>
                    </div>
                    <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
                </form>

                <!-- Error & Success messages -->
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error text-danger"><?= htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <p class="success text-success"><?= htmlspecialchars($_SESSION['success']); ?></p>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <p class="text-center mt-3">Sudah punya akun? <a href="/tokobekas/app/view/login.php">Login di sini</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk toggle password visibility
        function lihatPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        // Validasi form saat submit
        function validateForm() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let isValid = true;

            // Validasi Email (harus mengandung @gmail.com)
            if (!email.includes('@gmail.com')) {
                document.getElementById("emailError").style.display = "block";
                document.getElementById("email").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
                document.getElementById("email").classList.remove("is-invalid");
                document.getElementById("email").classList.add("is-valid");
            }

            // Validasi Password (minimal 5 karakter dan mengandung angka)
            const passwordRegex = /.*\d.*/; // Mengandung setidaknya 1 angka
            if (password.length < 5 || !passwordRegex.test(password)) {
                document.getElementById("passwordError").style.display = "block";
                document.getElementById("password").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("passwordError").style.display = "none";
                document.getElementById("password").classList.remove("is-invalid");
                document.getElementById("password").classList.add("is-valid");
            }

            return isValid;
        }

        // Instant feedback untuk email
        document.getElementById("email").addEventListener("input", function() {
            let email = this.value;
            if (!email.includes('@gmail.com')) {
                document.getElementById("emailError").style.display = "block";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("emailError").style.display = "none";
                this.classList.remove("is-invalid");
                this.classList.add("is-valid");
            }
        });

        // Instant feedback untuk password
        document.getElementById("password").addEventListener("input", function() {
            let password = this.value;
            const passwordRegex = /.*\d.*/; // Mengandung setidaknya 1 angka
            if (password.length < 5 || !passwordRegex.test(password)) {
                document.getElementById("passwordError").style.display = "block";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("passwordError").style.display = "none";
                this.classList.remove("is-invalid");
                this.classList.add("is-valid");
            }
        });
    </script>
</body>
</html>
