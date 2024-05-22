<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Data Inventaris<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Data Inventaris</h1>
    <a href="<?=base_url('data-inventaris/tambah')?>" class="btn btn-primary btn-sm"><i
            class="fa fa-plus me-2"></i>Tambah Inventaris</a>
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%">
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
                    <?php $no = 1;?>
                    <?php foreach ($inventariss as $inventaris): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$inventaris->kode_inventaris;?></td>
                        <td><?=$inventaris->nama;?></td>
                        <td><?=$inventaris->jumlah;?></td>
                        <td><?=$inventaris->kondisi;?></td>
                        <td><?=$inventaris->nama_ruangan;?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalFoto<?=$inventaris->id_inventaris?>"><i
                                    class="fa fa-image me-2"></i>Lihat Foto</button>
                            <a href="<?=base_url('data-inventaris/edit/' . $inventaris->id_inventaris)?>"
                                class="btn btn-warning btn-sm"><i class="fa fa-edit me-2"></i>Edit</a>
                            <a href="<?=base_url('data-inventaris/hapus/' . $inventaris->id_inventaris)?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                    class="fa fa-trash me-2"></i>Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Foto -->
<?php foreach ($inventariss as $inventaris): ?>
<div class="modal fade" id="modalFoto<?=$inventaris->id_inventaris?>" tabindex="-1"
    aria-labelledby="modalFoto<?=$inventaris->id_inventaris?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFoto<?=$inventaris->id_inventaris?>Label">Foto Inventaris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?=base_url('uploads/inventaris/foto/' . $inventaris->foto)?>" class="img-fluid"
                    alt="<?=$inventaris->nama;?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i
                        class="fa fa-close me-2"></i>Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<?=$this->endSection();?>