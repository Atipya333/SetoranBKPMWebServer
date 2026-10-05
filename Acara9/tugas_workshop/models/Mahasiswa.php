<?php
class Mahasiswa {
    private $nim;
    private $nama;

    public function setNim($nim) {
        if (!is_numeric($nim)) {
            throw new Exception("NIM harus berupa angka!");
        }
        $this->nim = $nim;
    }

    public function getNim() {
        return $this->nim;
    }

    public function setNama($nama) {
        if (empty(trim($nama))) {
            throw new Exception("Nama mahasiswa tidak boleh kosong!");
        }
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }
}