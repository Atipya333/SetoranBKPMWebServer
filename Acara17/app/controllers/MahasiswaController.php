
<?php

class MahasiswaController
{
    private Mahasiswa $model;

    public function __construct()
    {
        $this->model = new Mahasiswa();
    }

    private function respond(int $status, array $body): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($body, JSON_UNESCAPED_UNICODE);
    }

    private function input(): array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);

        return is_array($data) ? $data : [];
    }

    private function validasi(array $data): ?string
    {
        foreach (['nim', 'nama', 'prodi'] as $field) {
            if (!isset($data[$field]) ||
                !is_string($data[$field]) ||
                trim($data[$field]) === '') {
                return "Field $field wajib diisi dengan teks";
            }
        }

        if (strlen(trim($data['nim'])) > 15) {
            return 'NIM maksimal 15 karakter';
        }

        if (strlen(trim($data['nama'])) > 100) {
            return 'Nama maksimal 100 karakter';
        }

        if (strlen(trim($data['prodi'])) > 50) {
            return 'Prodi maksimal 50 karakter';
        }

        return null;
    }

    public function index(): void
    {
        try {
            $id = $_GET['id'] ?? null;

            if ($id !== null) {
                if (!ctype_digit((string) $id) || (int) $id < 1) {
                    $this->respond(400, [
                        'success' => false,
                        'message' => 'ID tidak valid'
                    ]);
                    return;
                }

                $data = $this->model->find((int) $id);

                if (!$data) {
                    $this->respond(404, [
                        'success' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                    return;
                }

                $this->respond(200, [
                    'success' => true,
                    'data' => $data
                ]);
                return;
            }

            $this->respond(200, [
                'success' => true,
                'data' => $this->model->getAll()
            ]);
        } catch (Throwable $e) {
            $this->respond(500, [
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function store(): void
    {
        $data = $this->input();
        $error = $this->validasi($data);

        if ($error !== null) {
            $this->respond(400, [
                'success' => false,
                'message' => $error
            ]);
            return;
        }

        $data = array_map(
            fn($v) => trim($v),
            $data
        );

        try {
            if ($this->model->nimExists($data['nim'])) {
                $this->respond(409, [
                    'success' => false,
                    'message' => 'NIM sudah terdaftar'
                ]);
                return;
            }

            $id = $this->model->create($data);

            $this->respond(201, [
                'success' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => ['id' => $id]
            ]);
        } catch (Throwable $e) {
            $this->respond(500, [
                'success' => false,
                'message' => 'Gagal menambahkan data'
            ]);
        }
    }

    public function update(int $id): void
    {
        if ($id < 1 || !$this->model->find($id)) {
            $this->respond(404, [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
            return;
        }

        $data = $this->input();
        $error = $this->validasi($data);

        if ($error !== null) {
            $this->respond(400, [
                'success' => false,
                'message' => $error
            ]);
            return;
        }

        $data = array_map(
            fn($v) => trim($v),
            $data
        );

        try {
            if ($this->model->nimExists($data['nim'], $id)) {
                $this->respond(409, [
                    'success' => false,
                    'message' => 'NIM sudah digunakan mahasiswa lain'
                ]);
                return;
            }

            $this->model->update($id, $data);

            $this->respond(200, [
                'success' => true,
                'message' => 'Data berhasil diperbarui'
            ]);
        } catch (Throwable $e) {
            $this->respond(500, [
                'success' => false,
                'message' => 'Gagal memperbarui data'
            ]);
        }
    }

    public function destroy(int $id): void
    {
        if ($id < 1 || !$this->model->find($id)) {
            $this->respond(404, [
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
            return;
        }

        try {
            $this->model->delete($id);

            $this->respond(200, [
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (Throwable $e) {
            $this->respond(500, [
                'success' => false,
                'message' => 'Gagal menghapus data'
            ]);
        }
    }
}
