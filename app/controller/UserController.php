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
            header("Location: /tokobekas/app/view/dashboarduser.php");
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
