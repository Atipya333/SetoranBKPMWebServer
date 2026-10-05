<?php
class MahasiswaRepository {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // 1. TAMBAH (Create)
    public function insert(Mahasiswa $mahasiswa) {
        $sql = "INSERT INTO mahasiswa (nim, nama) VALUES (:nim, :nama)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nim'  => $mahasiswa->getNim(),
            ':nama' => $mahasiswa->getNama()
        ]);
    }

    // 2. TAMPILKAN (Read All)
    public function findAll() {
        $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. UBAH (Update berdasarkan NIM)
    public function update(Mahasiswa $mahasiswa) {
        $sql = "UPDATE mahasiswa SET nama = :nama WHERE nim = :nim";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama' => $mahasiswa->getNama(),
            ':nim'  => $mahasiswa->getNim()
        ]);
    }

    // 4. HAPUS (Delete berdasarkan NIM)
    public function delete($nim) {
        $sql = "DELETE FROM mahasiswa WHERE nim = :nim";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':nim' => $nim]);
    }
}