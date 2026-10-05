<?php
// models/Model.php
require_once __DIR__ . '/../config/database.php';

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Method all() untuk mengambil seluruh baris data dari tabel
    public function all() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}