<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SI Akademik</title>
</head>
<body>
    <!-- Langkah 3: Menampilkan pesan selamat datang -->
    <h1>Selamat datang di SI Akademik</h1>

    <hr>

    <!-- Langkah 4a: Form Pencarian dengan Method GET -->
    <h2>Form Pencarian (GET)</h2>
    <form action="index.php" method="GET">
        <label for="keyword">Cari Data:</label>
        <input type="text" id="keyword" name="keyword" placeholder="Masukkan kata kunci...">
        <button type="submit">Cari</button>
    </form>

    <?php
    if (isset($_GET['keyword'])) {
        echo "<p>Hasil pencarian kata kunci: <strong>" . htmlspecialchars($_GET['keyword']) . "</strong></p>";
    }
    ?>

    <hr>

    <!-- Langkah 4b: Form Login Sederhana dengan Method POST -->
    <h2>Form Login (POST)</h2>
    <form action="index.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>

    <?php
    if (isset($_POST['username'])) {
        echo "<p>Login berhasil! Selamat datang, <strong>" . htmlspecialchars($_POST['username']) . "</strong>.</p>";
    }
    ?>
</body>
</html>
