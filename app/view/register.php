<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us | Register</title>
    <link rel="icon" href="/tokobekas/public/images/logo-tokobekas.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tokobekas/public/css/loginsignup.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100 p-4">
            <div class="col-lg-6 col-md-8 col-sm-10 register-container">
                <!-- Logo -->
                <img src="/tokobekas/public/images/logo-tokobekas.png" alt="Logo Toko Bekas" class="img-fluid mt-2 mb-2" style="max-width: 150px; display: block; margin: 0 auto;">
                
                <!-- Greeting and Title -->
                <h1 class="text-center mb-2">Join Our Community</h1>
                <p class="text-center text mb-2">Create an account and start exploring amazing deals today.</p>
                
                <!-- Register Form -->
                <form method="POST" action="/tokobekas/" onsubmit="return validateForm()" class="p-2">
                    <div class="mb-3">
                        <p class="text-start">Your Name</p>
                        <input type="text" name="nama" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <p class="text-start">Email</p>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                        <div id="emailError" class="invalid-feedback" style="display: none;">Email must end with @gmail.com.</div>
                    </div>
                    <div class="mb-3">
                        <p class="text-start">Password</p>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Your Password" required>
                        <div id="passwordError" class="invalid-feedback" style="display: none;">Password must be at least 5 characters and contain a number.</div>
                    </div>

                    <!-- Show Password -->
                    <div class="mb-2 form-check">
                        <input type="checkbox" onclick="lihatPassword()" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" name="register" class="btn btn-success w-100">Sign Up</button>
                </form>

                <!-- Error & Success Messages -->
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error text-danger mt-3 text-center"><?= htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <p class="success text-success mt-3 text-center"><?= htmlspecialchars($_SESSION['success']); ?></p>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <!-- Login Link -->
                <p class="text-center mt-2">Already have an account? <a href="/tokobekas/app/view/login.php">Login here</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function lihatPassword() {
            var x = document.getElementById("password");
            var showPasswordCheckbox = document.getElementById("showPassword");
            x.type = showPasswordCheckbox.checked ? "text" : "password";
        }
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
