<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Manajemen Akun<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Manajemen Akun</h1>
            <a href="<?= base_url('manajemen-akun/tambah') ?>" class="btn btn-primary">Tambah Akun</a>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Daftar Akun</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user->nama; ?></td>
                                <td><?= $user->email; ?></td>
                                <td><?= $user->nama_level; ?></td>
                                <td>
                                    <a href="<?= base_url('manajemen-akun/edit/' . $user->id_user) ?>"
                                        class="btn btn-warning">Edit</a>
                                    <?php if(session()->get('id_user') != $user->id_user): ?>
                                    <a href="<?= base_url('manajemen-akun/hapus/' . $user->id_user) ?>"
                                        class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    <?php endif; ?>
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
<?= $this->endSection(); ?>