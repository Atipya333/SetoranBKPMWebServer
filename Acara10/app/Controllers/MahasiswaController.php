<?php

// Naik 1 level (..) lalu masuk ke folder Repositories
require_once 'BaseController.php'; // Karena BaseController berada di folder yang sama (app/Controllers)
require_once __DIR__ . '/../Repositories/MahasiswaRepository.php';

class MahasiswaController extends BaseController {
    private $repository;

    public function __construct(MahasiswaRepository $repository) {
        $this->repository = $repository;
    }

    // Menampilkan daftar mahasiswa
    public function index() {
        $mahasiswa = $this->repository->getAll();
        $this->view('mahasiswa/index', ['mahasiswa' => $mahasiswa]);
    }

    // Menampilkan form tambah data
    public function create() {
        $this->view('mahasiswa/create');
    }

    // Menyimpan data mahasiswa baru
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $jurusan = $_POST['jurusan'];

            $this->repository->create($nim, $nama, $jurusan);
            $this->redirect('index.php');
        }
    }

    // Menampilkan form edit
    public function edit($id) {
        $mahasiswa = $this->repository->getById($id);
        $this->view('mahasiswa/edit', ['mahasiswa' => $mahasiswa]);
    }

    // Memperbarui data mahasiswa
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $jurusan = $_POST['jurusan'];

            $this->repository->update($id, $nim, $nama, $jurusan);
            $this->redirect('index.php');
        }
    }

    // Menghapus data mahasiswa
    public function delete($id) {
        $this->repository->delete($id);
        $this->redirect('index.php');
    }
}