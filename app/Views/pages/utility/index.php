<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Utilitas<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Utilitas</h1>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Database Backup</h5>
            <a href="<?=base_url('utility/hapus-semua')?>" class="btn btn-danger btn-sm" onclick="
                return confirm('Apakah Anda yakin ingin menghapus semua file backup database?')
            "><i class="fa fa-trash me-2"></i>Hapus Semua</a>
        </div>
        <div class="card-body">
            <a href="<?=base_url('utility/database-dump')?>" class="btn btn-warning btn-sm mb-3"><i
                    class="fa fa-database me-2"></i>Backup Database (sql)</a>
            <a href="<?=base_url('utility/database-dump-excel')?>" class="btn btn-warning btn-sm mb-3"><i
                    class="fa fa-file-excel me-2"></i>Backup Database (xlsx)</a>
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> <?=session()->getFlashdata('success')?>
                <?php if (session()->getFlashdata('file')): ?>
                <a target="_blank" href="<?=base_url('utility/download/' . session()->getFlashdata('file'))?>"
                    class="btn btn-secondary btn-sm"><i
                        class="fa fa-download me-2"></i><?=session()->getFlashdata('file')?></a>
                <?php endif;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?=session()->getFlashdata('error')?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>

            <?php if (isset($files) && count($files) > 0): ?>
            <div class="alert alert-info">
                <strong>Info!</strong> Backup database terakhir pada
                <strong><?=date('d F Y H:i:s', strtotime($latestFileTimestamp))?></strong>
                <a target="_blank" href="<?=base_url('utility/download/' . $latestFile)?>"
                    class="btn btn-secondary btn-sm"><i class="fa fa-download me-2"></i>Download</a>
            </div>
            <?php endif;?>
            <table class="table table-bordered table-striped table-hover table-responsive" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;foreach ($files as $file): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$file?></td>
                        <td>
                            <a target="_blank" href="<?=base_url('utility/download/' . $file)?>"
                                class="btn btn-success btn-sm"><i class="fa fa-download me-2"></i>Download</a>
                            <?php if (pathinfo($file, PATHINFO_EXTENSION) == 'xlsx'): ?>
                            <a href="<?=base_url('utility/restore-from-excel/' . $file)?>"
                                class="btn btn-primary btn-sm" onclick="
                                return confirm('Apakah Anda yakin ingin merestore data dari file ini?')
                                "><i class="fa fa-clock-rotate-left me-2"></i>Restore</a>
                            <?php endif;?>
                            <a href="<?=base_url('utility/hapus/' . $file)?>" class="btn btn-danger btn-sm" onclick="
                                return confirm('Apakah Anda yakin ingin menghapus file ini?')
                            "><i class="fa fa-trash me-2"></i>Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection();?>