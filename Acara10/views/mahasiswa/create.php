<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 300px; padding: 8px; }
        button { padding: 8px 16px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Tambah Data Mahasiswa</h2>
    <form action="index.php?action=store" method="POST">
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" name="nim" required>
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" required>
        </div>
        <button type="submit">Simpan</button>
        <a href="index.php">Batal</a>
    </form>

</body>
</html>