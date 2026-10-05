<?php
namespace App\Models; // Menggunakan namespace untuk mencegah konflik nama[cite: 2]

class Mahasiswa {
    // Property private untuk Enkapsulasi[cite: 2]
    private string $nim;
    private string $nama;

    public function __construct(string $nim, string $nama) {
        $this->nim = $nim;
        $this->nama = $nama;
    }

    // Metode Getter[cite: 2, 3]
    public function getNim(): string {
        return $this->nim;
    }

    public function getNama(): string {
        return $this->nama;
    }

    // Penyelesaian TUGAS MANDIRI: Mengembalikan angkatan berdasarkan 2 digit awal NIM
    public function getAngkatan(): string {
        // Mengambil 2 karakter pertama dari NIM menggunakan fungsi substr()
        $kodeTahun = substr($this->nim, 0, 2);
        
        // Menggabungkan dengan string "20" (Asumsi angkatan tahun 2000-an)
        return "20" . $kodeTahun; 
    }
}
?>