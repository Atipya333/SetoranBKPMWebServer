<?php
// repositories/ProdiRepository.php
require_once __DIR__ . '/../config/Database.php';

class ProdiRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all(): array {
        return $this->db->query("SELECT * FROM prodi ORDER BY id DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM prodi WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO prodi (nama_prodi) VALUES (:nama_prodi)");
        return $stmt->execute([':nama_prodi' => $data['nama_prodi']]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE prodi SET nama_prodi = :nama_prodi WHERE id = :id");
        return $stmt->execute([':id' => $id, ':nama_prodi' => $data['nama_prodi']]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM prodi WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}