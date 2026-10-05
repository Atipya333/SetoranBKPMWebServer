<?php
class MahasiswaController {
    private $repository;

    public function __construct(MahasiswaRepository $repository) {
        $this->repository = $repository;
    }

    // Tambah Data
    public function simpan($nim, $nama) {
        try {
            $mhs = new Mahasiswa();
            $mhs->setNim($nim);
            $mhs->setNama($nama);

            $this->repository->insert($mhs);
            return "✅ Berhasil menambah data mahasiswa ({$nama})";
        } catch (Exception $e) {
            return "❌ Gagal menyimpan: " . $e->getMessage();
        }
    }

    // Tampilkan Data
    public function index() {
        return $this->repository->findAll();
    }

    // Ubah Data
    public function ubah($nim, $namaBaru) {
        try {
            $mhs = new Mahasiswa();
            $mhs->setNim($nim);
            $mhs->setNama($namaBaru);

            $this->repository->update($mhs);
            return "✅ Berhasil memperbarui data mahasiswa NIM: {$nim}";
        } catch (Exception $e) {
            return "❌ Gagal mengubah: " . $e->getMessage();
        }
    }

    // Hapus Data
    public function hapus($nim) {
        try {
            $this->repository->delete($nim);
            return "🗑️ Berhasil menghapus mahasiswa NIM: {$nim}";
        } catch (Exception $e) {
            return "❌ Gagal menghapus: " . $e->getMessage();
        }
    }
}