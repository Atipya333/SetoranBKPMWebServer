<?php

class MahasiswaRepository 
{
    private $db;

    public function __construct($db) 
    {
        $this->db = $db;
    }

    public function all() 
    {
        $query = "SELECT m.*, p.nama_prodi 
                  FROM mahasiswa_simulasi m 
                  JOIN prodi p ON m.prodi_id = p.id 
                  ORDER BY m.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) 
    {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function existsByNim($nim, $excludeId = null) 
    {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim AND id != :id");
            $stmt->execute(['nim' => $nim, 'id' => $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = :nim");
            $stmt->execute(['nim' => $nim]);
        }
        return $stmt->fetchColumn() > 0;
    }

    public function create($data) 
    {
        $query = "INSERT INTO mahasiswa (nim, nama, email, angkatan, prodi_id) 
                  VALUES (:nim, :nama, :email, :angkatan, :prodi_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'nim'      => $data['nim'],
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'angkatan' => $data['angkatan'],
            'prodi_id' => $data['prodi_id']
        ]);
    }

    public function update($id, $data) 
    {
        $query = "UPDATE mahasiswa 
                  SET nim = :nim, nama = :nama, email = :email, angkatan = :angkatan, prodi_id = :prodi_id 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id'       => $id,
            'nim'      => $data['nim'],
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'angkatan' => $data['angkatan'],
            'prodi_id' => $data['prodi_id']
        ]);
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}