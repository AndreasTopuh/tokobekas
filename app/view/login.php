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
            background-image: url(https://www.technopedia.id/wp-content/uploads/2021/11/home1-1024x675-1.jpg)
        }
        h1, h2{
            color: rgb(0, 0, 0)
        }
        .btn{
            background-color: #4CAF50;
        }
        .btn:hover{
            background-color: #3e8e41;
        }
        .static{
            position: absolute;
            background: #4CAF50;
            width: 100%;
            height: 80px;
        }
        .wave-container{
            position: relative;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }
        .waves{
            position: absolute;
            bottom: 30;
            width: 100%;
            height: 100px;
            background: #4CAF50;
            border-radius: 70%;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
        .wave{
            animation: waveAnimation 5s infinite;
        }
        .wave1{
            background: rgb(76, 175, 80);
            animation: waveAnimation 6s infinite;
            /* bottom: -10px; */
        }
        .wave2{
            background: rgb(76, 175, 80);
            animation: waveAnimation 7s infinite;
            /* bottom: -20px; */
        }
        .login-container {
            max-width: 350px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(3px);
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

        @keyframes waveAnimation{
            0% {transform: translateX(100%);
            }

            100%{transform: translateX(-100%)}
        }
    </style>
</head>
<body>
    <div class="login-container mt-5">
        <div class="logo">
            <h1>Toko Bekas</h1> <!-- Ganti dengan logo Anda -->
        </div>
        <h2 class="text-center">Login</h2>
        <h3 class="text-center"> Masukan Email dan Password anda</h3>
        <form method="POST" action="/tokobekas/index.php">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn w-100">Login</button>
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
    
    <div class="wave-container">
            <div class="waves wave"></div>
            <div class="waves wave1"></div>
            <div class="waves wave2"></div>
            <div class="static"></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
