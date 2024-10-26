<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <h1>Pendaftaran Pengguna</h1>
    <form method="POST" action="/tokobekas/aimvc/">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Daftar</button>
    </form>

    <?php 
    session_start();
    if (isset($_SESSION['error'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_SESSION['error']); ?></p>
        <?php unset($_SESSION['error']); // Clear the error message after displaying ?>
    <?php endif; ?>

    <p><a href="/tokobekas/aimvc/">Kembali ke halaman login</a></p>
</body>
</html>
