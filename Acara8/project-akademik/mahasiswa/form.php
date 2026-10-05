<?php
// mahasiswa/form.php
require_once __DIR__ . '/../repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../repositories/ProdiRepository.php';

$mhsRepo = new MahasiswaRepository();
$prodiRepo = new ProdiRepository();

$prodiList = $prodiRepo->all();
$id = $_GET['id'] ?? null;
$mhs = $id ? $mhsRepo->find((int)$id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nim'      => $_POST['nim'],
        'nama'     => $_POST['nama'],
        'email'    => $_POST['email'],
        'prodi_id' => $_POST['prodi_id']
    ];

    if ($id) {
        $mhsRepo->update((int)$id, $data);
    } else {
        $mhsRepo->create($data);
    }
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Mahasiswa</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mhs['nim'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mhs['nama'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mhs['email'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <select name="prodi_id" class="form-select" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php foreach ($prodiList as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= (isset($mhs['prodi_id']) && $mhs['prodi_id'] == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nama_prodi']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>