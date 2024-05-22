<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Buat Peminjaman<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Buat Peminjaman Barang</h1>
    <a href="<?=base_url('user/peminjaman')?>" class="btn btn-secondary btn-sm"><i
            class="fa fa-arrow-left me-2"></i>Kembali</a>
    <div class="card mt-4">
        <div class="card-header">
            Data Peminjaman
        </div>
        <form action="/user/peminjaman/tambah" method="post">
            <?=csrf_field();?>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian"
                                name="tanggal_pengembalian" required>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (session()->has('keranjang')): ?>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save me-2"></i>Buat
                    Peminjaman</button>
            </div>
            <?php endif;?>
        </form>
    </div>
    <div class="row ">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-header">
                    Daftar Barang
                </div>
                <div class="card-body">
                    <table class="table" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
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
                                <td>
                                    <?php if ($inventaris->jumlah == 0): ?>
                                    <span class="badge bg-danger">Kosong</span>
                                    <?php else: ?>
                                    <?=$inventaris->jumlah;?>
                                    <?php endif;?>
                                </td>
                                <td><?=$inventaris->nama_ruangan;?></td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm" id="tambahBarang" data-bs-toggle="modal"
                                        data-bs-target="#modalTambahBarang" data-id="<?=$inventaris->id_inventaris;?>"
                                        data-kode="<?=$inventaris->kode_inventaris;?>"
                                        data-nama="<?=$inventaris->nama;?>" data-jumlah="<?=$inventaris->jumlah?>"><i
                                            class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-header">
                    Daftar Barang Dipinjam
                </div>
                <div class="card-body">
                    <?php if (session()->has('keranjang')): ?>
                    <div
                        class="d-flex flex-row justify-content-between align-content-center align-items-center text-center  mb-3 mx-2">
                        <a href="<?=base_url('/user/peminjaman/hapus-keranjang')?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus keranjang ini?')"><i
                                class="fa fa-trash me-2"></i>Hapus Semua</a>
                        <p class="text-center">Total Barang: <?=count(session()->get('keranjang'))?></p>
                    </div>
                    <?php endif;?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php if (session()->has('keranjang')): ?>
                            <?php foreach (session()->get('keranjang') as $item): ?>
                            <tr>
                                <td><?=$no++;?></td>
                                <td><?=$item['kode_inventaris'];?></td>
                                <td><?=$item['nama'];?></td>
                                <td><?=$item['jumlah'];?></td>
                                <td>
                                    <a href="/user/peminjaman/hapus-item-keranjang/<?=$item['row_id'];?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // Modal Tambah Barang ke Keranjang -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/user/peminjaman/tambah-item-keranjang" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang ke Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalTambahBarangBody">

                    <input type="hidden" class="form-control" id="id_inventaris" name="id_inventaris" readonly>

                    <div class="mb-3">
                        <label for="kode_inventaris" class="form-label" id="kode_inventaris">Kode Inventaris</label>
                        <input type="text" class="form-control" id="kode_inventaris" name="kode_inventaris" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label" id="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label" id="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1" value="1">
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

<?=$this->endSection();?>
<?=$this->section('scripts');?>
<script>
$(document).ready(function() {
    $('#modalTambahBarang').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var kode = button.data('kode');
        var nama = button.data('nama');
        var jumlah = button.data('jumlah');

        var modal = $(this);
        modal.find('.modal-body #id_inventaris').val(id);
        modal.find('.modal-body #kode_inventaris').val(kode);
        modal.find('.modal-body #nama').val(nama);
        modal.find('.modal-body #jumlah').attr('max', jumlah);
    });

    //#tanggal_peminjaman set value to current date
    var today = new Date().toISOString().split('T')[0];
    $('#tanggal_peminjaman').val(today);
});
</script>
<?=$this->endSection();?>