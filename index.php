<?php

//Stanislaus Nicko Fasio Priyanjaga
//121140076
//RB

//Memulai sesi PHP
session_start();

//Memeriksa apakah pengguna sudah masuk, jika tidak, alihkan ke halaman masuk.php
if(!isset($_SESSION['user'])) {
    header("location: masuk.php");
    exit();
}

//Memproses logout jika formulir logout disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    //Menghancurkan sesi dan mengalihkan ke halaman masuk.php
    session_destroy();
    header("location: masuk.php");
    exit();
}

//Memasukkan file proses.php dan myobject.php
include "proses.php";
include "myobject.php";

//Membuat objek data dan object myobject
$data = new data();
$myobject = new myobject($data);

//Memproses penghapusan data ketika formulir hapus submit
if (isset($_POST['submit'])) {
    $myobject->addData($_POST['nama'], $_POST['email'], $_POST['subscribe'], $_POST['gender']);
}

//Memproses penghapusan data ketika formulir hapus submit
if (isset($_POST['hapus'])) {
    $myobject->removeData($_POST['hapus']);
}

//Mendapatkan informasi data menggunakan object myobject
$info = $myobject->getData();

//Menutup koneksi ke database
$data->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Uas Pemweb</title>
</head>
<body>
    <!-- Formulir untuk pengisian data subcriber -->
    <form id="myForm" method="post">
        <h3>Form Pengisian Subscriber</h3>
        <label for="nama">Name:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <input type="checkbox" id="subscribe" name="subscribe">
        <label for="subscribe">Subscribe to Stanislaus Nicko</label><br>

        <label for="gender">Gender:</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br>

        <input type="submit" name="submit" value="Submit">
    </form>

    <!-- Formulir untuk menghapus data berdasarkan nama -->
    <form method="post">
            <label for="hapus">Delete Data (by name):</label>
            <input type="text" id="hapus" name="hapus" required>
            <button type="submit">Hapus</button>
    </form>

    <!-- Tabel untuk menampilkan data subcriber -->
    <table id="dataTable" border="1">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Subscribe</th>
            <th>Gender</th>
        </tr>
        <?php
        // Looping untuk menampilkan data dari variabel $info ke dalam tabel
        foreach ($info as $row) {
            echo "
            <tr>
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td>{$row['subscribe']}</td>
                <td>{$row['gender']}</td>
            <tr>";
        }
        ?>
    </table>

    <!-- Formulir untuk logout -->
    <form method="post"><button type="submit" name="logout">Logout</button></form>

    <!--Memasukkan skrip JavaScript -->
    <script src="script.js"></script>
</body>
</html>