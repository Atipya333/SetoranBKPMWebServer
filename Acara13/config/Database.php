<?php

class Database 
{
    private static $host = 'localhost';
    private static $db_name = 'siakademik';
    private static $username = 'root';
    private static $password = ''; // Isikan password MySQL jika ada (default XAMPP/Laragon biasanya kosong)
    private static $pdo = null;

    public static function getConnection() 
    {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";
                self::$pdo = new PDO($dsn, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Koneksi Database Gagal: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}