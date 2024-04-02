<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Data Ruangan<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Data Ruangan</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Ruangan
            </button>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Daftar Ruangan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($ruangans as $ruangan) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $ruangan->nama_ruangan; ?></td>
                                    <td>
                                        <!-- Lihat Foto Ruangan -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFoto<?= $ruangan->id_ruangan ?>">Lihat Foto</button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $ruangan->id_ruangan ?>">Edit</button>
                                        <a href="<?= base_url('data-ruangan/hapus/' . $ruangan->id_ruangan) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('data-ruangan/tambah') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
                    </div>
                    <!-- Foto Ruangan -->
                    <div class="mb-3">
                        <label for="foto_ruangan" class="form-label">Foto Ruangan</label>
                        <input type="file" class="form-control" id="foto_ruangan" name="foto_ruangan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Foto Ruangan -->
<?php foreach ($ruangans as $ruangan) : ?>
    <div class="modal fade" id="modalFoto<?= $ruangan->id_ruangan ?>" tabindex="-1" aria-labelledby="modalFotoLabel<?= $ruangan->id_ruangan ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFotoLabel<?= $ruangan->id_ruangan ?>">Foto Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('uploads/ruangan/foto/' . $ruangan->foto) ?>" class="img-fluid" alt="Foto Ruangan">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Edit -->
<?php foreach ($ruangans as $ruangan) : ?>
    <div class="modal fade" id="modalEdit<?= $ruangan->id_ruangan ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $ruangan->id_ruangan ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $ruangan->id_ruangan ?>">Edit Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('data-ruangan/edit/' . $ruangan->id_ruangan) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" value="<?= $ruangan->nama_ruangan ?>" required>
                        </div>
                        <!-- Foto Ruangan -->
                        <div class="mb-3">
                            <label for="foto_ruangan" class="form-label">Foto Ruangan</label>
                            <input type="file" class="form-control" id="foto_ruangan" name="foto_ruangan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>