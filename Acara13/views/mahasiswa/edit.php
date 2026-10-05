<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">Ubah Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="index.php?page=mahasiswa_update" method="POST">
                    <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?= htmlspecialchars($mahasiswa['nim']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($mahasiswa['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi_id" class="form-label">Program Studi</label>
                        <select class="form-select" id="prodi_id" name="prodi_id" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php foreach ($prodiList as $p): ?>
                                <option value="<?= $p['id']; ?>" <?= $p['id'] == $mahasiswa['prodi_id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($p['nama_prodi']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php?page=mahasiswa" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>