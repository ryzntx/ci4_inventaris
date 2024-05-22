<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Data Inventaris<?=$this->endSection();?>
<?=$this->section('content');?>
<!-- Edit Data -->
<!-- Data Inventaris ['kode_inventaris', 'nama', 'merek', 'speksifikasi', 'kondisi', 'jumlah', 'harga', 'sumber', 'foto', 'id_ruangan', 'id_user'] -->
<div class="container-fluid px-4 mt-4">
    <h1>Edit Data Inventaris</h1>
    <a href="<?=base_url('data-inventaris')?>" class="btn btn-secondary btn-sm"><i
            class="fa fa-arrow-left me-2"></i>Kembali</a>
    <div class="card mt-4">
        <div class="card-header">
            Form Edit Data Inventaris
        </div>
        <form action="<?=base_url('data-inventaris/edit/' . $inventaris->id_inventaris)?>" method="post"
            enctype="multipart/form-data">
            <div class="card-body">
                <img src="<?=base_url('uploads/inventaris/foto/' . $inventaris->foto)?>" alt="Foto Inventaris"
                    class="img-thumbnail mb-3" style="width: 20%;">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="kode_inventaris" class="form-label">Kode Inventaris</label>
                    <input type="text" class="form-control" id="kode_inventaris" name="kode_inventaris"
                        value="<?=$inventaris->kode_inventaris?>">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?=$inventaris->nama?>">
                </div>
                <div class="mb-3">
                    <label for="merek" class="form-label">Merek</label>
                    <input type="text" class="form-control" id="merek" name="merek" value="<?=$inventaris->merek?>">
                </div>
                <div class="mb-3">
                    <label for="speksifikasi" class="form-label">Speksifikasi</label>
                    <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="3"
                        class="form-control"><?=$inventaris->spesifikasi?></textarea>
                </div>
                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select class="form-select" id="kondisi" name="kondisi">
                        <option value="Baik" <?=$inventaris->kondisi == 'Baik' ? 'selected' : ''?>>Baik</option>
                        <option value="Rusak" <?=$inventaris->kondisi == 'Rusak' ? 'selected' : ''?>>Rusak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                        value="<?=$inventaris->jumlah?>">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?=$inventaris->harga?>">
                </div>
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber</label>
                    <input type="text" class="form-control" id="sumber" name="sumber" value="<?=$inventaris->sumber?>">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="mb-3">
                    <label for="id_ruangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="id_ruangan" name="id_ruangan">
                        <option selected>Pilih Ruangan</option>
                        <?php foreach ($ruangans as $ruangan): ?>
                        <option value="<?=$ruangan->id_ruangan?>"
                            <?=$inventaris->id_ruangan == $ruangan->id_ruangan ? 'selected' : ''?>>
                            <?=$ruangan->nama_ruangan?></option>
                        <?php endforeach;?>
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