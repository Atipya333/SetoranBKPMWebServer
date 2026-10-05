<?php
require_once 'config/Database.php';
require_once 'models/Mahasiswa.php';
require_once 'repositories/MahasiswaRepository.php';
require_once 'controllers/MahasiswaController.php';

// Inisialisasi Dependency Injection
$db = new Database('localhost', 'db_mahasiswa', 'root', '');
$repo = new MahasiswaRepository($db);
$controller = new MahasiswaController($repo);

$pesan = '';
$modeEdit = false;
$editNim = '';
$editNama = '';

// Handling Form Submission & Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'tambah') {
            $pesan = $controller->simpan($_POST['nim'], $_POST['nama']);
        } elseif ($_POST['action'] === 'ubah') {
            $pesan = $controller->ubah($_POST['nim'], $_POST['nama']);
        }
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'hapus' && isset($_GET['nim'])) {
        $pesan = $controller->hapus($_GET['nim']);
    } elseif ($_GET['action'] === 'edit' && isset($_GET['nim']) && isset($_GET['nama'])) {
        $modeEdit = true;
        $editNim = $_GET['nim'];
        $editNama = $_GET['nama'];
    }
}

// Ambil semua data mahasiswa untuk ditampilkan di tabel
$dataMahasiswa = call_user_func([$controller, 'index']) ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        h2 { color: #333; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; text-decoration: none; display: inline-block; }
        .btn-green { background-color: #28a745; }
        .btn-blue { background-color: #007bff; }
        .btn-yellow { background-color: #ffc107; color: black; }
        .btn-red { background-color: #dc3545; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; background-color: #e2e3e5; color: #383d41; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Aplikasi Manajemen Data Mahasiswa</h2>

    <!-- Alert Notifikasi -->
    <?php if (!empty($pesan)): ?>
        <div class="alert"><?= $pesan ?></div>
    <?php endif; ?>

    <!-- Form Input / Edit Data -->
    <div class="card">
        <h3><?= $modeEdit ? 'Ubah Data Mahasiswa' : 'Tambah Data Mahasiswa' ?></h3>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="<?= $modeEdit ? 'ubah' : 'tambah' ?>">
            
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($editNim) ?>" <?= $modeEdit ? 'readonly style="background:#e9ecef;"' : '' ?> required placeholder="Masukkan NIM (harus angka)">
            </div>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa:</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($editNama) ?>" required placeholder="Masukkan Nama Mahasiswa">
            </div>

            <button type="submit" class="btn <?= $modeEdit ? 'btn-blue' : 'btn-green' ?>">
                <?= $modeEdit ? 'Simpan Perubahan' : 'Tambah Data' ?>
            </button>
            <?php if ($modeEdit): ?>
                <a href="index.php" class="btn btn-red">Batal</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Tabel Data Mahasiswa -->
    <div class="card">
        <h3>Daftar Mahasiswa</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Waktu Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dataMahasiswa) > 0): ?>
                    <?php $no = 1; foreach ($dataMahasiswa as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td>
                                <a href="index.php?action=edit&nim=<?= urlencode($row['nim']) ?>&nama=<?= urlencode($row['nama']) ?>" class="btn btn-yellow">Edit</a>
                                <a href="index.php?action=hapus&nim=<?= urlencode($row['nim']) ?>" class="btn btn-red" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada data mahasiswa.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>