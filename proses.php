<?php

//Stanislaus Nicko Fasio Priyanjaga
//121140076
//RB

//Defini kelas "data"
class data {
    //Properti privasi untuk informasi koneksi database
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "uas";
    //Properti untuk menyimpan objek koneksi
    private $connection;

    //Kontruksi kelas untuk inisialisasi koneksi saat objek dibuat
    public function __construct() {
        //Membuat objek koneksi menggunakan informasi yang diberikan
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        //Memeriksa apakah koneksi sukses
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    //Metode untuk mendapatkan objek koneksi
    public function getConnection() {
        return $this->connection;
    }

    //Metode untuk menutup koneksi database
    public function closeConnection() {
        $this->connection->close();
    }
}
?>
