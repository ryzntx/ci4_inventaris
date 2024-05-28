<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Manajemen Akun<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Manajemen Akun</h1>
    <a href="<?=base_url('manajemen-akun/tambah')?>" class="btn btn-primary btn-sm"><i
            class="fa fa-plus me-2"></i>Tambah Akun</a>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Akun</h5>
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-cog me-2"></i>Alat
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?=base_url('manajemen-akun/export-excel')?>"><i
                                class="fa fa-file-excel me-2"></i>Export to
                            Excel</a></li>
                    <li>
                        <form class="dropdown-item" action="<?=base_url('manajemen-akun/import-excel')?>" method="post"
                            enctype="multipart/form-data" id="uploadForm">
                            <!-- <?=csrf_field()?> -->
                            <label>
                                <i class="fa fa-file-import me-2"></i>Import from Excel <input type="file" name="file"
                                    id="fileInput" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                    application/vnd.ms-excel" required>
                            </label>
                        </form>
                    </li>
                    <li><a class="dropdown-item" href="<?=base_url('manajemen-akun/download-excel')?>"><i
                                class="fa fa-file-download me-2"></i>Download Excel</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="dataTable" width="100%">
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
                    <?php $no = 1;?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$user->nama;?></td>
                        <td><?=$user->email;?></td>
                        <td><?=$user->nama_level;?></td>
                        <td>
                            <a href="<?=base_url('manajemen-akun/edit/' . $user->id_user)?>"
                                class="btn btn-warning btn-sm"><i class="fa fa-edit me-2"></i>Edit</a>
                            <?php if (session()->get('id_user') != $user->id_user): ?>
                            <a href="<?=base_url('manajemen-akun/hapus/' . $user->id_user)?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                    class="fa fa-trash me-2"></i>Hapus</a>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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