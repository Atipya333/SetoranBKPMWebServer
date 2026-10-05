<?php

class MahasiswaController 
{
    private $mahasiswaService;

    public function __construct($mahasiswaService) 
    {
        $this->mahasiswaService = $mahasiswaService;
    }

    public function index() 
    {
        $mahasiswa = $this->mahasiswaService->getAllMahasiswa();
        $viewContent = __DIR__ . '/../views/mahasiswa/index.php';
        require __DIR__ . '/../views/layout.php';
    }

    public function create() 
    {
        $prodiList = $this->mahasiswaService->getAllProdi();
        $viewContent = __DIR__ . '/../views/mahasiswa/create.php';
        require __DIR__ . '/../views/layout.php';
    }

    // PRG: POST -> Redirect GET (Poin 8)
    public function store() 
    {
        $data = [
            'nim'      => trim($_POST['nim'] ?? ''),
            'nama'     => trim($_POST['nama'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'angkatan' => trim($_POST['angkatan'] ?? ''),
            'prodi_id' => $_POST['prodi_id'] ?? ''
        ];

        $success = $this->mahasiswaService->create($data);

        if ($success) {
            header('Location: index.php?page=mahasiswa');
        } else {
            header('Location: index.php?page=mahasiswa_create');
        }
        exit;
    }

    public function edit() 
    {
        $id = $_GET['id'] ?? null;
        $mahasiswa = $this->mahasiswaService->getMahasiswaById($id);

        if (!$mahasiswa) {
            header('Location: index.php?page=mahasiswa');
            exit;
        }

        $prodiList = $this->mahasiswaService->getAllProdi();
        $viewContent = __DIR__ . '/../views/mahasiswa/edit.php';
        require __DIR__ . '/../views/layout.php';
    }

    // PRG: POST -> Redirect GET (Poin 8)
    public function update() 
    {
        $id = $_POST['id'] ?? null;
        $data = [
            'nim'      => trim($_POST['nim'] ?? ''),
            'nama'     => trim($_POST['nama'] ?? ''),
            'email'    => trim($_POST['email'] ?? ''),
            'angkatan' => trim($_POST['angkatan'] ?? ''),
            'prodi_id' => $_POST['prodi_id'] ?? ''
        ];

        $success = $this->mahasiswaService->update($id, $data);

        if ($success) {
            header('Location: index.php?page=mahasiswa');
        } else {
            header("Location: index.php?page=mahasiswa_edit&id={$id}");
        }
        exit;
    }

    public function delete() 
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->mahasiswaService->delete($id);
        }
        header('Location: index.php?page=mahasiswa');
        exit;
    }
}