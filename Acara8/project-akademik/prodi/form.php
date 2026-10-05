<?php
// prodi/form.php
require_once __DIR__ . '/../repositories/ProdiRepository.php';

$repo = new ProdiRepository();
$id = $_GET['id'] ?? null;
$prodi = $id ? $repo->find((int)$id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['nama_prodi' => $_POST['nama_prodi']];
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
    <title><?= $id ? 'Edit' : 'Tambah' ?> Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Program Studi</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" class="form-control" value="<?= htmlspecialchars($prodi['nama_prodi'] ?? '') ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>