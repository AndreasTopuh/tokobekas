<?php
namespace Controller;

use Model\UserModel;

class UserController {
    private $userModel;

    public function __construct() {
        error_reporting(E_ALL & ~E_NOTICE);
        session_start(); // Memastikan session dimulai di sini
        $this->userModel = new UserModel();
    }

    public function login($email, $password) {
        $user = $this->userModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: /tokobekas/app/view/barang_list.php");
            exit();
        } else {
            $_SESSION['error'] = $this->userModel->emailExists($email) ? 
                "Invalid/unmatched role, email or password." : "Email not registered!";
            header("Location: /tokobekas/index.php");
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /tokobekas/index.php");
        exit();
    }

    public function register($nama, $email, $password) {
        if (empty($nama) || empty($email) || empty($password)) {
            $_SESSION['error'] = "All fields are required!";
            header("Location: /tokobekas/app/view/register.php");
            exit();
        }

        // Validasi email harus mengandung @gmail.com
        if (strpos($email, '@gmail.com') === false) {
            $_SESSION['error'] = "Email must be from @gmail.com domain.";
            header("Location: /tokobekas/app/view/register.php");
            exit();
        }

        // Validasi password: minimal 5 karakter dan mengandung setidaknya 1 angka
        if (strlen($password) < 5 || !preg_match('/\d/', $password)) {
            $_SESSION['error'] = "Password must be at least 5 characters long and contain at least one number.";
            header("Location: /tokobekas/app/view/register.php");
            exit();
        }

        // Check if the email is already registered
        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = "Email already registered!";
            header("Location: /tokobekas/app/view/register.php");
            exit();
        }

        // Hash the password before saving it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Try to register the user with the hashed password
        if ($this->userModel->register($nama, $email, $hashedPassword)) {
            $_SESSION['success'] = "Registration successful! Please log in.";
            header("Location: /tokobekas/");
            exit();
        } else {
            $_SESSION['error'] = "Failed to register!";
            header("Location: /tokobekas/app/view/register.php");
            exit();
        }
    }

}

$controller = new UserController();
