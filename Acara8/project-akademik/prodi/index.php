<?php
// prodi/index.php
require_once __DIR__ . '/../repositories/ProdiRepository.php';

$repo = new ProdiRepository();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $repo->delete((int)$_GET['id']);
    header("Location: index.php");
    exit;
}

$prodiList = $repo->all();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php">Sistem Akademik</a>
    <div class="navbar-nav">
      <a class="nav-link" href="../mahasiswa/index.php">Mahasiswa</a>
      <a class="nav-link active" href="index.php">Prodi</a>
      <a class="nav-link" href="../matakuliah/index.php">Mata Kuliah</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Program Studi</h3>
        <a href="form.php" class="btn btn-primary">+ Tambah Prodi</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Program Studi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($prodiList)): ?>
                        <tr><td colspan="3" class="text-center text-muted">Data Prodi belum ada.</td></tr>
                    <?php else: ?>
                        <?php foreach ($prodiList as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                                <td class="text-center">
                                    <a href="form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?action=delete&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Apakah Anda yakin menghapus Prodi ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>