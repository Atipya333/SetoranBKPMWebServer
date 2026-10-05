<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 300px; padding: 8px; }
        button { padding: 8px 16px; background-color: #ffc107; color: black; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Edit Data Mahasiswa</h2>
    <form action="index.php?action=update&id=<?= $mahasiswa['id']; ?>" method="POST">
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" name="nim" value="<?= htmlspecialchars($mahasiswa['nim']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($mahasiswa['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" value="<?= htmlspecialchars($mahasiswa['jurusan']); ?>" required>
        </div>
        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>

</body>
</html>