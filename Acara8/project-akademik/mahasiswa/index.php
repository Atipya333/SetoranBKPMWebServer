<?php
// mahasiswa/index.php
require_once __DIR__ . '/../repositories/MahasiswaRepository.php';

$repo = new MahasiswaRepository();
$search = $_GET['search'] ?? '';

// Penanganan Hapus Data
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $repo->delete((int)$_GET['id']);
    header("Location: index.php");
    exit;
}

// Tugas Mandiri: Panggil search jika keyword diisi[cite: 1]
$mahasiswaList = !empty($search) ? $repo->search($search) : $repo->all();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-link navbar-brand fw-bold" href="../index.php">Sistem Akademik</a>
    <div class="navbar-nav">
      <a class="nav-link active" href="index.php">Mahasiswa</a>
      <a class="nav-link" href="../prodi/index.php">Prodi</a>
      <a class="nav-link" href="../matakuliah/index.php">Mata Kuliah</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mahasiswa</h3>
        <a href="form.php" class="btn btn-primary">+ Tambah Mahasiswa</a>
    </div>

    <!-- Form Pencarian (Tugas Mandiri)[cite: 1] -->
    <form method="GET" action="index.php" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama / NIM..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Cari</button>
            <?php if (!empty($search)): ?>
                <a href="index.php" class="btn btn-outline-secondary">Reset</a>
            <?php endif; ?>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Program Studi</th> <!-- Menampilkan hasil JOIN[cite: 1] -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($mahasiswaList)): ?>
                        <tr><td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($mahasiswaList as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= htmlspecialchars($row['nama_prodi'] ?? 'Belum Set') ?></span></td>
                                <td class="text-center">
                                    <a href="form.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <!-- Konfirmasi JS sebelum hapus[cite: 1] -->
                                    <a href="index.php?action=delete&id=<?= $row['id'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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