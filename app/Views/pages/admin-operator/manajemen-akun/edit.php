<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Manajemen Akun<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Manajemen Akun</h1>
    <a href="<?=base_url('manajemen-akun')?>" class="btn btn-secondary btn-sm"><i
            class="fa fa-arrow-left me-2"></i>Kembali</a>
    <div class="card mt-4">
        <div class="card-header">
            <h5>Edit Akun</h5>
        </div>
        <form action="<?=base_url('manajemen-akun/edit/' . $user->id_user)?>" method="post"
            enctype="multipart/form-data">
            <?=csrf_field();?>
            <div class="card-body">
                <div class="form-group">
                    <?php if ($user->foto): ?>
                    <img src="<?=base_url('uploads/foto/' . $user->foto)?>" alt="User Foto" class="img-thumbnail"
                        width="150">
                    <?php else: ?>
                    <p>No foto available</p>
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?=$user->nama;?>" required>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?=$user->username;?>" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?=$user->email;?>" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Level</label>
                    <select name="id_level" class="form-control" required>
                        <option value="">Pilih Level</option>
                        <?php foreach ($levels as $level): ?>
                        <option value="<?=$level->id_level;?>"
                            <?=$level->id_level == $user->id_level ? 'selected' : '';?>>
                            <?=$level->nama_level;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" <?=$user->status == 'Aktif' ? 'selected' : '';?>>Aktif</option>
                        <option value="Non-Aktif" <?=$user->status == 'Non-Aktif' ? 'selected' : '';?>>Tidak
                            Aktif
                        </option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save me-2"></i>Perbaharui</button>
            </div>
        </form>
    </div>
</div>


<?=$this->endSection();?>