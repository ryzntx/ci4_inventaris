<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Data Inventaris<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Data Inventaris</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= base_url('data-inventaris/tambah') ?>" class="btn btn-primary">Tambah Inventaris</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Inventaris</th>
                        <th>Nama Inventaris</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($inventariss as $inventaris) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $inventaris->kode_inventaris; ?></td>
                            <td><?= $inventaris->nama; ?></td>
                            <td><?= $inventaris->jumlah; ?></td>
                            <td><?= $inventaris->kondisi; ?></td>
                            <td><?= $inventaris->nama_ruangan; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFoto<?= $inventaris->id_inventaris ?>">Lihat Foto</button>
                                <a href="<?= base_url('data-inventaris/edit/' . $inventaris->id_inventaris) ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('data-inventaris/hapus/' . $inventaris->id_inventaris) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Foto -->
<?php foreach ($inventariss as $inventaris) : ?>
    <div class="modal fade" id="modalFoto<?= $inventaris->id_inventaris ?>" tabindex="-1" aria-labelledby="modalFoto<?= $inventaris->id_inventaris ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFoto<?= $inventaris->id_inventaris ?>Label">Foto Inventaris</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('uploads/inventaris/foto/' . $inventaris->foto) ?>" class="img-fluid" alt="<?= $inventaris->nama; ?>">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>