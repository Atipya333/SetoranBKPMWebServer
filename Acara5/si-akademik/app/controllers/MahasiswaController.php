<?php

class MahasiswaController {
    public function index() {
        echo "Halaman Daftar Mahasiswa";
    }

    public function create() {
        echo "Halaman Form Tambah Mahasiswa";
    }

    // Method untuk memenuhi Tugas Mandiri
    public function show($id) {
        echo "Detail Mahasiswa dengan ID: " . htmlspecialchars($id);
    }
}