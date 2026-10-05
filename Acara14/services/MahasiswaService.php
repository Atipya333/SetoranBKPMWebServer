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
        try {
            return $this->mahasiswaRepository->all();
        } catch (Exception $e) {
            $this->logError("Error saat mengambil data mahasiswa: " . $e->getMessage());
            return [];
        }
    }

    public function getAllProdi() 
    {
        try {
            return $this->prodiRepository->getAll();
        } catch (Exception $e) {
            $this->logError("Error saat mengambil data prodi: " . $e->getMessage());
            return [];
        }
    }

    public function getMahasiswaById($id) 
    {
        try {
            return $this->mahasiswaRepository->find($id);
        } catch (Exception $e) {
            $this->logError("Error saat mencari id {$id}: " . $e->getMessage());
            return null;
        }
    }

    // Logging ke storage/logs/app.log (Poin 6)
    private function logError($message) 
    {
        $logDir = __DIR__ . '/../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        $logFile = $logDir . '/app.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] ERROR: {$message}" . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);
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

    // Validasi Input (NIM, Nama, Email, Duplikat NIM) (Poin 4)
    public function validateData($data, $isUpdate = false, $currentId = null) 
    {
        $errors = [];

        // Validasi NIM
        if (empty(trim($data['nim']))) {
            $errors[] = "NIM wajib diisi.";
        } elseif ($this->mahasiswaRepository->existsByNim(trim($data['nim']), $currentId)) {
            $errors[] = "NIM sudah terdaftar.";
        }

        // Validasi Nama
        if (empty(trim($data['nama']))) {
            $errors[] = "Nama wajib diisi.";
        }

        // Validasi Email
        if (empty(trim($data['email']))) {
            $errors[] = "Email wajib diisi.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak valid.";
        }

        // Validasi Angkatan
        if (empty(trim($data['angkatan']))) {
            $errors[] = "Angkatan wajib diisi.";
        }

        // Validasi Prodi
        if (empty($data['prodi_id'])) {
            $errors[] = "Program Studi wajib dipilih.";
        }

        return $errors;
    }

    // Method Create dengan Exception Handling (Poin 5 & 6)
    public function create($data) 
    {
        try {
            $errors = $this->validateData($data);

            if (!empty($errors)) {
                if (in_array("NIM sudah terdaftar.", $errors)) {
                    $this->setFlashMessage('danger', 'NIM sudah terdaftar.');
                } else {
                    $this->setFlashMessage('danger', 'Data gagal disimpan.');
                }
                return false;
            }

            $result = $this->mahasiswaRepository->create($data);

            if ($result) {
                $this->setFlashMessage('success', 'Data mahasiswa berhasil ditambahkan.');
                return true;
            } else {
                $this->setFlashMessage('danger', 'Data gagal disimpan.');
                return false;
            }
        } catch (Exception $e) {
            $this->logError("Gagal menambahkan mahasiswa: " . $e->getMessage());
            $this->setFlashMessage('danger', 'Data gagal disimpan.');
            return false;
        }
    }

    // Method Update dengan Exception Handling (Poin 5 & 6)
    public function update($id, $data) 
    {
        try {
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
                $this->setFlashMessage('success', 'Data mahasiswa berhasil diubah.');
                return true;
            } else {
                $this->setFlashMessage('danger', 'Data gagal disimpan.');
                return false;
            }
        } catch (Exception $e) {
            $this->logError("Gagal mengubah mahasiswa ID {$id}: " . $e->getMessage());
            $this->setFlashMessage('danger', 'Data gagal disimpan.');
            return false;
        }
    }

    // Method Delete dengan Exception Handling (Poin 5 & 6)
    public function delete($id) 
    {
        try {
            $result = $this->mahasiswaRepository->delete($id);
            if ($result) {
                $this->setFlashMessage('success', 'Data mahasiswa berhasil dihapus.');
                return true;
            } else {
                $this->setFlashMessage('danger', 'Data gagal dihapus.');
                return false;
            }
        } catch (Exception $e) {
            $this->logError("Gagal menghapus mahasiswa ID {$id}: " . $e->getMessage());
            $this->setFlashMessage('danger', 'Data gagal dihapus.');
            return false;
        }
    }
}