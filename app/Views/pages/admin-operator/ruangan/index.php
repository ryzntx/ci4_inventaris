<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Data Ruangan<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Data Ruangan</h1>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fa fa-plus me-2"></i>Tambah Ruangan
    </button>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Ruangan</h5>
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-cog me-2"></i>Alat
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?=base_url('data-ruangan/export-excel')?>"><i
                                class="fa fa-file-excel me-2"></i>Export to
                            Excel</a></li>
                    <li>
                        <form class="dropdown-item" action="<?=base_url('data-ruangan/import-excel')?>" method="post"
                            enctype="multipart/form-data" id="uploadForm">
                            <!-- <?=csrf_field()?> -->
                            <label>
                                <i class="fa fa-file-import me-2"></i>Import from Excel <input type="file" name="file"
                                    id="fileInput" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                    application/vnd.ms-excel" required>
                            </label>
                        </form>
                    </li>
                    <li><a class="dropdown-item" href="<?=base_url('data-ruangan/download-excel')?>"><i
                                class="fa fa-file-download me-2"></i>Download Excel</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($ruangans as $ruangan): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$ruangan->nama_ruangan;?></td>
                        <td>
                            <!-- Lihat Foto Ruangan -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalFoto<?=$ruangan->id_ruangan?>"><i
                                    class="fa fa-image me-2"></i>Lihat Foto</button>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?=$ruangan->id_ruangan?>"><i
                                    class="fa fa-edit me-2"></i>Edit</button>
                            <a href="<?=base_url('data-ruangan/hapus/' . $ruangan->id_ruangan)?>"
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


<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('data-ruangan/tambah')?>" method="post" enctype="multipart/form-data">
                <?=csrf_field()?>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i
                            class="fa fa-close me-2"></i>Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus me-2"></i>Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Foto Ruangan -->
<?php foreach ($ruangans as $ruangan): ?>
<div class="modal fade" id="modalFoto<?=$ruangan->id_ruangan?>" tabindex="-1"
    aria-labelledby="modalFotoLabel<?=$ruangan->id_ruangan?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotoLabel<?=$ruangan->id_ruangan?>">Foto Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?=base_url('uploads/ruangan/foto/' . $ruangan->foto)?>" class="img-fluid" alt="Foto Ruangan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i
                        class="fa fa-close me-2"></i>Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>

<!-- Modal Edit -->
<?php foreach ($ruangans as $ruangan): ?>
<div class="modal fade" id="modalEdit<?=$ruangan->id_ruangan?>" tabindex="-1"
    aria-labelledby="modalEditLabel<?=$ruangan->id_ruangan?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel<?=$ruangan->id_ruangan?>">Edit Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('data-ruangan/edit/' . $ruangan->id_ruangan)?>" method="post"
                enctype="multipart/form-data">
                <?=csrf_field()?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan"
                            value="<?=$ruangan->nama_ruangan?>" required>
                    </div>
                    <!-- Foto Ruangan -->
                    <div class="mb-3">
                        <label for="foto_ruangan" class="form-label">Foto Ruangan</label>
                        <input type="file" class="form-control" id="foto_ruangan" name="foto_ruangan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i
                            class="fa fa-close me-2"></i>Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i
                            class="fa fa-save me-2"></i>Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>

<?=$this->endSection();?>

<?=$this->section('scripts')?>
<script>
$(document).ready(function() {

    $('#fileInput').change(function(e) {
        e.preventDefault();
        console.log('File changed');
        $('#uploadForm').submit();
    });
});
</script>
<?=$this->endSection()?>