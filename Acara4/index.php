<?php
// Menggunakan require_once untuk file class (Best Practice)[cite: 1]
require_once __DIR__ . '/Models/Mahasiswa.php';
use App\Models\Mahasiswa;

// Langkah 4: Membuat beberapa object Mahasiswa (sementara)[cite: 3]
$mhs1 = new Mahasiswa("21098765", "Andi Budiman");
$mhs2 = new Mahasiswa("22112233", "Siti Aisyah");
$mhs3 = new Mahasiswa("20554433", "Budi Santoso");

// Menyimpan object ke dalam array untuk dilooping
$data_mahasiswa = [$mhs1, $mhs2, $mhs3];

// Menggunakan include untuk memanggil partial view[cite: 1, 3]
include 'views/partials/header.php';
include 'views/partials/navbar.php';
?>

<!-- Langkah 5: Tampilkan data dalam tabel Bootstrap[cite: 3] -->
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Mahasiswa</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan (Tugas Mandiri)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_mahasiswa as $mhs): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <!-- Mengambil data menggunakan metode getter dari class[cite: 2] -->
                        <td><?= $mhs->getNim() ?></td>
                        <td><?= $mhs->getNama() ?></td>
                        <!-- Menampilkan hasil Tugas Mandiri -->
                        <td><?= $mhs->getAngkatan() ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Memanggil bagian penutup HTML (footer)[cite: 1]
include 'views/partials/footer.php';
?>