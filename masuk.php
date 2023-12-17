<?php

//Stanislaus Nicko Fasio Priyanjaga
//121140076
//RB

//Memulai sesi PHP
session_start();

//Memeriksa apakah pengguna sudah masuk, jika iya, alihkan ke halaman index.php
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

//Memproses data formulir saat metode POST digunakan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mengambil data dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Memeriksa kecocokan username dan password
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        //Jika cocok, membuat sesi pengguna dan mengalihkan ke halaman index.php
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        //Jika tidak cocok, menetapkan pesan error
        $error = "Username atau password salah";
    }
}

//Memproses permintaan logout melalui query string
if (isset($_GET['logout'])) {
    //Menghacurkan sesi dan mengalihkan ke halaman login.php
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style_masuk.css">
    <title>Login Page</title>
</head>
<body>
    <!-- Container untuk halaman login -->
    <div class="login-container">
        <h2>Login</h2>
        
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        
        <!-- Formulir untuk login -->
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Tombol untuk mengirimkan formulir -->
            <button type="submit">Login</button>
        </form>

        <!-- Tautan untuk membuat akun baru -->
        <p><a href="daftar.php">Silahkan buat akun baru</a></p>
    </div>
</body>
</html>
