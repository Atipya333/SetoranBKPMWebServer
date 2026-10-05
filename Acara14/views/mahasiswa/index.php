<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Mahasiswa</h3>
    <a href="index.php?page=mahasiswa_create" class="btn btn-primary">Tambah Mahasiswa</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th>Program Studi</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswa)): ?>
                    <tr><td colspan="7" class="text-center py-3">Belum ada data mahasiswa.</td></tr>
                <?php else: ?>
                    <?php foreach ($mahasiswa as $index => $m): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($m['nim']); ?></td>
                            <td><?= htmlspecialchars($m['nama']); ?></td>
                            <td><?= htmlspecialchars($m['email']); ?></td>
                            <td><?= htmlspecialchars($m['angkatan']); ?></td>
                            <td><?= htmlspecialchars($m['nama_prodi']); ?></td>
                            <td class="text-center">
                                <a href="index.php?page=mahasiswa_edit&id=<?= $m['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?page=mahasiswa_delete&id=<?= $m['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>