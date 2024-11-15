<?php
session_start(); // Memulai session

require_once './app/core/Database.php';
require_once './app/model/UserModel.php';
require_once './app/controller/UserController.php';

use Controller\UserController;

// Cek apakah pengguna sudah login
if (isset($_SESSION['user'])) {
    header("Location: /tokobekas/app/view/dashboarduser.php");
    exit();
}

$userController = new UserController();

// Tangani login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $userController->login($email, $password);
}

// Tangani registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $userController->register($nama, $email, $password);
}

// Tampilkan halaman login secara default
include './app/view/login.php';
