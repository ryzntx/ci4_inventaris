<?= $this->extend('layouts/base-layout'); ?>
<?= $this->section('title'); ?>Data Inventaris<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<!-- Tambah Data -->
<!-- Data Inventaris ['kode_inventaris', 'nama', 'merek', 'speksifikasi', 'kondisi', 'jumlah', 'harga', 'sumber', 'foto', 'id_ruangan', 'id_user'] -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Tambah Data Inventaris</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= base_url('data-inventaris') ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Form Tambah Data Inventaris
        </div>
        <div class="card-body">
            <form action="<?= base_url('data-inventaris/tambah') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="kode_inventaris" class="form-label">Kode Inventaris</label>
                    <input type="text" class="form-control" id="kode_inventaris" name="kode_inventaris">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="merek" class="form-label">Merek</label>
                    <input type="text" class="form-control" id="merek" name="merek">
                </div>
                <div class="mb-3">
                    <label for="speksifikasi" class="form-label">Speksifikasi</label>
                    <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select class="form-select" id="kondisi" name="kondisi">
                        <option selected>Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga">
                </div>
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber</label>
                    <input type="text" class="form-control" id="sumber" name="sumber">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="mb-3">
                    <label for="id_ruangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="id_ruangan" name="id_ruangan">
                        <option selected>Pilih Ruangan</option>
                        <?php foreach ($ruangans as $ruangan) : ?>
                            <option value="<?= $ruangan->id_ruangan ?>"><?= $ruangan->nama_ruangan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>