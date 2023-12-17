<?php

//Stanislaus Nicko Fasio Priyanjaga
//121140076
//RB

//Defini kelas "myobject"
class myobject {
    //Properti untuk menyimpan objek data (objek kelas "data")
    private $data;

    //Konstruksi kelas untuk menginisialisasi objek data saat objek "myobject" dibuat
    public function __construct($data) {
        $this->data = $data;
    }

    //Metode untuk menambahkan data ke tabel "uas"
    public function addData($nama, $email, $subscribe, $gender) {
        $connection = $this->data->getConnection();
        $nama = $connection->real_escape_string($nama);
        $email = $connection->real_escape_string($email);
        $subscribe = $connection->real_escape_string($subscribe);
        $gender = $connection->real_escape_string($gender);
        //Memeriksa apakah data dengan nama yang sama sudah ada
        $existingData = $connection->query("SELECT * FROM uas WHERE nama = '$nama'");
        //Jika belum ada data dengan nama yang sama, tambahkan data baru
        if ($existingData->num_rows == 0) {
            $query = "INSERT INTO uas (nama, email, subscribe, gender) VALUES ('$nama', '$email', '$subscribe', '$gender')";
            $connection->query($query);
        }
    }

    //Metode untuk mendapatkan semua data dari tabel "uas"
    public function getData() {
        $connection = $this->data->getConnection();
        $result = $connection->query("SELECT * FROM uas");

        $info = array();
        while ($row = $result->fetch_assoc()) {
            $info[] = $row;
        }
        return $info;
    }

    //Metode untuk menghapus data dari tabel "uas" berdasarkan nama
    public function removeData($nama) {
        $connection = $this->data->getConnection();
        $nama = $connection->real_escape_string($nama);

        $query = "DELETE FROM uas WHERE nama = '$nama' ";
        $connection->query($query);
    }

    //Metode untuk mendaftarkan pengguna baru ke tabel "account"
    public function registerUser($email, $username, $hashedPassword) {
        $connection = $this->data->getConnection();
        $email = $connection->real_escape_string($email);
        $username = $connection->real_escape_string($username);

        $query = "INSERT INTO account (email, username, password) VALUES ('$username', '$hashedPassword')";
        $connection->query($query);
    }

    //Metode untuk memeriksa apakah username sudah digunakan
    public function checkUsername($username) {
        $connection = $this->data->getConnection();
        $username = $connection->real_escape_string($username);

        $result = $connection->query("SELECT * FROM account WHERE username = '$username'");
        return $result->num_rows > 0;
    }
}
?>
