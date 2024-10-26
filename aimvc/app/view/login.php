<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="/tokobekas/aimvc/index.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_SESSION['error']); ?></p>
        <?php unset($_SESSION['error']); // Clear error message after displaying ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color:green;"><?= htmlspecialchars($_SESSION['success']); ?></p>
        <?php unset($_SESSION['success']); // Clear success message after displaying ?>
    <?php endif; ?>
    
    <p>Jika Anda belum terdaftar, silakan <a href="/tokobekas/aimvc/app/view/register.php">daftar di sini</a>.</p>
</body>
</html>
