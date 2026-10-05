<?php

class MahasiswaRepository {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Ambil semua data mahasiswa (Read)
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data mahasiswa berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah data mahasiswa (Create)
    public function create($nim, $nama, $jurusan) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (:nim, :nama, :jurusan)");
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jurusan', $jurusan);
        return $stmt->execute();
    }

    // Ubah data mahasiswa (Update)
    public function update($id, $nim, $nama, $jurusan) {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, jurusan = :jurusan WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jurusan', $jurusan);
        return $stmt->execute();
    }

    // Hapus data mahasiswa (Delete)
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}