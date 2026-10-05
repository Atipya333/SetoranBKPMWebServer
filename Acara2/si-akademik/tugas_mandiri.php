<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Mandiri - Request Method Detector</title>
</head>
<body>
    <h1>Deteksi Request Method HTTP</h1>

    <!-- Logika Pendeteksian Request Method dengan $_SERVER['REQUEST_METHOD'] -->
    <?php
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'POST') {
        echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px;'>";
        echo "<h3>Request Method yang Terdeteksi: POST</h3>";
        echo "<p>Halaman ini dipanggil menggunakan metode <strong>POST</strong>. Data dikirimkan secara tersembunyi di dalam HTTP Body.</p>";
        if (isset($_POST['nama_lengkap'])) {
            echo "<p>Data yang dikirimkan: <strong>" . htmlspecialchars($_POST['nama_lengkap']) . "</strong></p>";
        }
        echo "</div>";
    } else if ($method === 'GET') {
        echo "<div style='background-color: #cce5ff; color: #004085; padding: 15px; border-radius: 5px;'>";
        echo "<h3>Request Method yang Terdeteksi: GET</h3>";
        echo "<p>Halaman ini dipanggil menggunakan metode <strong>GET</strong>. Data dikirimkan melalui URL.</p>";
        if (isset($_GET['kategori'])) {
            echo "<p>Data URL Parameter: <strong>" . htmlspecialchars($_GET['kategori']) . "</strong></p>";
        }
        echo "</div>";
    }
    ?>

    <hr>

    <!-- Pengujian 1: Pengiriman data via GET -->
    <h3>Uji Coba Method GET</h3>
    <form action="tugas_mandiri.php" method="GET">
        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" placeholder="Contoh: Web Server">
        <button type="submit">Kirim Request GET</button>
    </form>

    <br>

    <!-- Pengujian 2: Pengiriman data via POST -->
    <h3>Uji Coba Method POST</h3>
    <form action="tugas_mandiri.php" method="POST">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama...">
        <button type="submit">Kirim Request POST</button>
    </form>
</body>
</html>
