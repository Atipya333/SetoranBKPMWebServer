<?php
// mahasiswa.php
require_once __DIR__ . '/models/MahasiswaModel.php';

$mahasiswaModel = new MahasiswaModel();
$dataMahasiswa = $mahasiswaModel->all();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - SI Akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .badge-aktif {
            color: green;
            font-weight: bold;
        }
        .badge-cuti {
            color: orange;
            font-weight: bold;
        }
        .badge-lulus {
            color: blue;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Daftar Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>ID Prodi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dataMahasiswa)): ?>
                <?php foreach ($dataMahasiswa as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['nim']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['id_prodi']); ?></td>
                    <td>
                        <span class="badge-<?= htmlspecialchars($row['status']); ?>">
                            <?= ucfirst(htmlspecialchars($row['status'])); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Data mahasiswa kosong.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>