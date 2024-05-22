<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Data Peminjaman<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">

    <h1>Data Peminjaman</h1>
    <a href="<?=base_url('peminjaman')?>" class="btn btn-secondary btn-sm"><i
            class="fa fa-arrow-left me-2"></i>Kembali</a>
    <div class="card mt-4">
        <div class="card-header">
            Data Peminjaman
        </div>
        <form action="/peminjaman/edit/<?=$peminjaman->id_peminjaman?>" method="post">
            <?=csrf_field();?>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                required readonly value="<?=date('Y-m-d', strtotime($peminjaman->tgl_pinjam));?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal
                                Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian"
                                name="tanggal_pengembalian" required
                                value="<?=date('Y-m-d', strtotime($peminjaman->tgl_kembali));?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status_peminjaman" class="form-label">Status Peminjaman</label>
                    <select class="form-select" id="status_peminjaman" name="status_peminjaman" required>
                        <option value="Menunggu Persetujuan"
                            <?=$peminjaman->status_peminjaman == 'Menunggu Persetujuan' ? 'selected' : '';?>>
                            Menunggu Persetujuan</option>
                        <option value="Pinjaman Ditolak"
                            <?=$peminjaman->status_peminjaman == 'Pinjaman Ditolak' ? 'selected' : '';?>>
                            Pinjaman Ditolak</option>
                        <option value="Dipinjam" <?=$peminjaman->status_peminjaman == 'Dipinjam' ? 'selected' : '';?>>
                            Dipinjam</option>
                        <option value="Dikembalikan"
                            <?=$peminjaman->status_peminjaman == 'Dikembalikan' ? 'selected' : '';?>>
                            Dikembalikan</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save me-2"></i>Perbaharui
                    Peminjaman</button>
            </div>
        </form>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Daftar Barang Dipinjam
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Ruangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($detail_peminjaman as $item): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$item->kode_inventaris;?></td>
                        <td><?=$item->nama;?></td>
                        <td><?=$item->nama_ruangan?></td>
                        <td><?=$item->jumlah;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

</div>



<?=$this->endSection();?>