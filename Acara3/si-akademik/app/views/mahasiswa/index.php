<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa - SI Akademik</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SI Akademik</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-dark">Daftar Mahasiswa</h3>
            <a href="create.php" class="btn btn-primary">+ Tambah Mahasiswa</a>
        </div>

        <!-- Tabel Responsif -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <td>220101001</td>
                                <td>Budi Santoso</td>
                                <td>Teknik Informatika</td>
                                <td>budi@example.com</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">2</th>
                                <td>220101002</td>
                                <td>Siti Aminah</td>
                                <td>Sistem Informasi</td>
                                <td>siti@example.com</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>