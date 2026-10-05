<?php

class MahasiswaRepository 
{
    private $db;

    public function __construct($db) 
    {
        $this->db = $db;
    }

    public function getAll() 
    {
        $query = "SELECT m.*, p.nama_prodi 
                  FROM mahasiswa m 
                  JOIN prodi p ON m.prodi_id = p.id 
                  ORDER BY m.id DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function findById($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByNim($nim) 
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE nim = :nim");
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch();
    }

    public function insert($data) 
    {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, prodi_id) VALUES (:nim, :nama, :prodi_id)");
        return $stmt->execute([
            'nim'      => $data['nim'],
            'nama'     => $data['nama'],
            'prodi_id' => $data['prodi_id']
        ]);
    }

    public function update($id, $data) 
    {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, prodi_id = :prodi_id WHERE id = :id");
        return $stmt->execute([
            'id'       => $id,
            'nim'      => $data['nim'],
            'nama'     => $data['nama'],
            'prodi_id' => $data['prodi_id']
        ]);
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}