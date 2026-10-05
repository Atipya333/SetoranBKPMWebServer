<?php
require_once __DIR__ . '/../../Helpers/Session.php';
$flashSuccess = Session::getFlash('success');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <!-- Alert Flash Message Selamat Datang -->
    <?php if ($flashSuccess): ?>
        <div style="padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 10px;">
            <?= htmlspecialchars($flashSuccess); ?>
        </div>
    <?php endif; ?>

    <h2>Halaman Dashboard / Mahasiswa</h2>
    <p>Halaman ini berhasil diakses setelah melalui proteksi AuthMiddleware.</p>

    <a href="<?= BASE_URL ?>/logout">Logout</a>
</body>
</html>