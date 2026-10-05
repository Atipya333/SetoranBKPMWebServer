<?php
// matakuliah/form.php
require_once __DIR__ . '/../repositories/MataKuliahRepository.php';

$repo = new MataKuliahRepository();
$id = $_GET['id'] ?? null;
$mk = $id ? $repo->find((int)$id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'kode_mk' => $_POST['kode_mk'],
        'nama_mk' => $_POST['nama_mk'],
        'sks'     => $_POST['sks']
    ];
    if ($id) {
        $repo->update((int)$id, $data);
    } else {
        $repo->create($data);
    }
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Mata Kuliah</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode MK</label>
                    <input type="text" name="kode_mk" class="form-control" value="<?= htmlspecialchars($mk['kode_mk'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" class="form-control" value="<?= htmlspecialchars($mk['nama_mk'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">SKS</label>
                    <input type="number" name="sks" class="form-control" value="<?= htmlspecialchars($mk['sks'] ?? '') ?>" min="1" max="6" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>