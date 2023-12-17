<?php

//Stanislaus Nicko Fasio Priyanjaga
//121140076
//RB

session_start();

//Memasukkan file proses.php dan myobject.php
include "proses.php";
include "myobject.php";

//Membuat object data dan object myobject
$data = new data();
$myobject = new myobject($data);

//Memeriksa apakah pengguna sudah masuk, jika iya, alihkan ke halaman index.php
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

//Memproses data formulir saat metode POST digunakan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mengambil data dari formulir
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Mengenkripsi password menggunakan metode hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    //Memeriksa apakah username sudah digunakan
    $existingData = $myobject->checkUsername($username);
    //Jika username belum digunakan, daftarkan pengguna
    if (!$existingData) {
        $myobject->registerUser($email, $username, $hashedPassword);

        //Membuat sesi pengguna dan mengalihkan ke halaman index.php
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        //Jika username sudah digunakan, menetapkan pesan error
        $error = "Username sudah digunakan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="regis.css">
    <title>Signup Page</title>
</head>
<body>
    <!-- Container untuk halaman pendaftaran -->
    <div class="signup-container">
        <h2>Sign Up</h2>

        <?php
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }

        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <!-- Formulir untuk pendaftaran -->
        <form action="index.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Tombol untuk mengirimkan formulir -->
            <button type="submit">Sign Up</button>
        </form>

        <!-- Tautan untuk login  jika sudah memiliki akun -->
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>