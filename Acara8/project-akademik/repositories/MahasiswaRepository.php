<?php
// repositories/MahasiswaRepository.php
require_once __DIR__ . '/../config/Database.php';

class MahasiswaRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Mengambil semua data mahasiswa dengan JOIN ke tabel prodi[cite: 1]
    public function all(): array {
        $sql = "SELECT m.*, p.nama_prodi 
                FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id 
                ORDER BY m.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    // Tugas Mandiri: Pencarian berbasis nama atau NIM dengan LIKE & Prepared Statement[cite: 1]
    // (SUDAH DIPERBAIKI: Menggunakan nama parameter unik :nama dan :nim untuk mencegah error HY093)
    public function search(string $keyword): array {
        $sql = "SELECT m.*, p.nama_prodi 
                FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id 
                WHERE m.nama LIKE :nama OR m.nim LIKE :nim 
                ORDER BY m.id DESC";
                
        $stmt = $this->db->prepare($sql);
        $searchTerm = '%' . $keyword . '%';
        
        $stmt->execute([
            ':nama' => $searchTerm,
            ':nim'  => $searchTerm
        ]);
        
        return $stmt->fetchAll();
    }

    // Mengambil 1 data mahasiswa berdasarkan ID[cite: 1]
    public function find(int $id): ?array {
        $sql = "SELECT * FROM mahasiswa WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    // Tambah data mahasiswa[cite: 1]
    public function create(array $data): bool {
        $sql = "INSERT INTO mahasiswa (nim, nama, email, prodi_id) VALUES (:nim, :nama, :email, :prodi_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nim'      => $data['nim'],
            ':nama'     => $data['nama'],
            ':email'    => $data['email'],
            ':prodi_id' => $data['prodi_id']
        ]);
    }

    // Update data mahasiswa[cite: 1]
    public function update(int $id, array $data): bool {
        $sql = "UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'       => $id,
            ':nim'      => $data['nim'],
            ':nama'     => $data['nama'],
            ':email'    => $data['email'],
            ':prodi_id' => $data['prodi_id']
        ]);
    }

    // Hapus data mahasiswa[cite: 1]
    public function delete(int $id): bool {
        $sql = "DELETE FROM mahasiswa WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}