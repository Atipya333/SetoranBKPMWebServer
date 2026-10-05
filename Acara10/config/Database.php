<?php

class Database {
    private $host = "localhost";      // Server host
    private $db_name = "mahasiswa"; // Nama database yang disesuaikan
    private $username = "root";       // Username MySQL bawaan XAMPP/Laragon
    private $password = "";           // Password MySQL (default kosong)
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}