<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Manajemen Akun<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Manajemen Akun</h1>
    <a href="<?=base_url('manajemen-akun')?>" class="btn btn-secondary btn-sm"><i
            class="fa fa-arrow-left me-2"></i>Kembali</a>
    <div class="card mt-4">
        <div class="card-header">
            <h5>Tambah Akun</h5>
        </div>
        <form action="<?=base_url('manajemen-akun/tambah')?>" method="post" enctype="multipart/form-data">
            <?=csrf_field();?>
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Level</label>
                    <select name="id_level" class="form-control" required>
                        <option value="">Pilih Level</option>
                        <?php foreach ($levels as $level): ?>
                        <option value="<?=$level->id_level;?>"><?=$level->nama_level;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save me-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>

<?=$this->endSection();?>