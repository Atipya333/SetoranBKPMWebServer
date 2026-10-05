<?php

class MahasiswaService 
{
    private $mahasiswaRepository;
    private $prodiRepository;

    public function __construct($mahasiswaRepository, $prodiRepository) 
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->prodiRepository = $prodiRepository;
    }

    public function getAllMahasiswa() 
    {
        return $this->mahasiswaRepository->getAll();
    }

    public function getAllProdi() 
    {
        return $this->prodiRepository->getAll();
    }

    public function getMahasiswaById($id) 
    {
        return $this->mahasiswaRepository->findById($id);
    }

    public function setFlashMessage($type, $message) 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash_message'] = [
            'type'    => $type,
            'message' => $message
        ];
    }

    public function validateData($data, $isUpdate = false, $currentId = null) 
    {
        $errors = [];

        if (empty(trim($data['nim']))) {
            $errors[] = "NIM wajib diisi.";
        } else {
            $existing = $this->mahasiswaRepository->findByNim($data['nim']);
            if ($existing && (!$isUpdate || $existing['id'] != $currentId)) {
                $errors[] = "NIM sudah terdaftar.";
            }
        }

        if (empty(trim($data['nama']))) {
            $errors[] = "Nama wajib diisi.";
        }

        if (empty($data['prodi_id'])) {
            $errors[] = "Program Studi wajib dipilih.";
        }

        return $errors;
    }

    public function create($data) 
    {
        $errors = $this->validateData($data);

        if (!empty($errors)) {
            if (in_array("NIM sudah terdaftar.", $errors)) {
                $this->setFlashMessage('danger', 'NIM sudah terdaftar.');
            } else {
                $this->setFlashMessage('danger', 'Data gagal disimpan.');
            }
            return false;
        }

        $result = $this->mahasiswaRepository->insert($data);

        if ($result) {
            $this->setFlashMessage('success', 'Data berhasil ditambahkan.');
            return true;
        } else {
            $this->setFlashMessage('danger', 'Data gagal disimpan.');
            return false;
        }
    }

    public function update($id, $data) 
    {
        $errors = $this->validateData($data, true, $id);

        if (!empty($errors)) {
            if (in_array("NIM sudah terdaftar.", $errors)) {
                $this->setFlashMessage('danger', 'NIM sudah terdaftar.');
            } else {
                $this->setFlashMessage('danger', 'Data gagal disimpan.');
            }
            return false;
        }

        $result = $this->mahasiswaRepository->update($id, $data);

        if ($result) {
            $this->setFlashMessage('success', 'Data berhasil diubah.');
            return true;
        } else {
            $this->setFlashMessage('danger', 'Data gagal disimpan.');
            return false;
        }
    }

    public function delete($id) 
    {
        return $this->mahasiswaRepository->delete($id);
    }
}