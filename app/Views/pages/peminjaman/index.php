<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Data Peminjaman<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Data Peminjaman</h1>
            <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary">Tambah Peminjaman</a>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Daftar Peminjaman</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Nama Peminjam</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($peminjamans as $peminjaman) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- parse tgl_pinjam to date -->
                                <td><?= date('d-m-Y', strtotime($peminjaman->tgl_pinjam)); ?></td>
                                <td><?= date('d-m-Y', strtotime($peminjaman->tgl_kembali)); ?></td>
                                <td><?= $peminjaman->nama; ?></td>
                                <td><?= $peminjaman->status_peminjaman; ?></td>
                                <td>
                                    <a href="<?= base_url('peminjaman/lihat/' . $peminjaman->id_peminjaman) ?>"
                                        class="btn btn-info">Lihat</a>
                                    <a href="<?= base_url('peminjaman/hapus/' . $peminjaman->id_peminjaman) ?>"
                                        class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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