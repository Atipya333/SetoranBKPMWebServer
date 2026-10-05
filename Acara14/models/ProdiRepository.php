<?php

class ProdiRepository 
{
    private $db;

    public function __construct($db) 
    {
        $this->db = $db;
    }

    public function getAll() 
    {
        $stmt = $this->db->query("SELECT * FROM prodi ORDER BY nama_prodi ASC");
        return $stmt->fetchAll();
    }
}