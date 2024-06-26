<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Data Peminjaman<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">

    <h1>Data Peminjaman</h1>
    <a href="<?=base_url('peminjaman/tambah')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus me-2"></i>Tambah
        Peminjaman</a>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Peminjaman</h5>
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-cog me-2"></i>Alat
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?=base_url('peminjaman/cetak')?>" target="_blank" class="dropdown-item"><i
                                class="fa fa-print me-2"></i>Cetak / Print</a></li>
                    <li><a href="<?=base_url('peminjaman/export-pdf')?>" class="dropdown-item"><i
                                class="fa fa-file-pdf me-2"></i>Export PDF</a></li>
                    <li><a href="<?=base_url('peminjaman/export-excel')?>" class="dropdown-item"><i
                                class="fa fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Nama Peminjam</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($peminjamans as $peminjaman): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <!-- parse tgl_pinjam to date -->
                        <td><?=date('d-m-Y', strtotime($peminjaman->tgl_pinjam));?></td>
                        <td><?=date('d-m-Y', strtotime($peminjaman->tgl_kembali));?></td>
                        <td><?=$peminjaman->nama;?></td>
                        <td><?php if ($peminjaman->status_peminjaman == 'Menunggu Persetujuan'): ?>
                            <span class="badge text-bg-secondary"><?=$peminjaman->status_peminjaman;?></span>
                            <?php elseif ($peminjaman->status_peminjaman == 'Pinjaman Ditolak'): ?>
                            <span class="badge text-bg-danger"><?=$peminjaman->status_peminjaman;?></span>
                            <?php elseif ($peminjaman->status_peminjaman == 'Dipinjam'): ?>
                            <span class="badge text-bg-primary"><?=$peminjaman->status_peminjaman;?></span>
                            <?php elseif ($peminjaman->status_peminjaman == 'Dikembalikan'): ?>
                            <span class="badge text-bg-success"><?=$peminjaman->status_peminjaman;?></span>
                            <?php endif;?>
                        </td>
                        <td>
                            <a href="<?=base_url('peminjaman/lihat/' . $peminjaman->id_peminjaman)?>"
                                class="btn btn-info btn-sm"><i class="fa fa-eye me-2"></i>Lihat</a>
                            <a href="<?=base_url('peminjaman/hapus/' . $peminjaman->id_peminjaman)?>"
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


<?=$this->endSection();?>