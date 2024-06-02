<?=$this->extend('layouts/base-layout');?>
<?=$this->section('title');?>Laporan<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="container-fluid px-4 mt-4">
    <h1>Laporan</h1>
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-inline-flex gap-1">
                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                    <i class="fa fa-filter me-2"></i>Opsi Filter
                </button>
                <a href="<?=base_url('laporan/pdf?' . request()->getUri()->getQuery())?>"
                    class="btn btn-danger btn-sm"><i class="fa fa-file-pdf me-2"></i>PDF</a>
                <a href="<?=base_url('laporan/excel?' . request()->getUri()->getQuery())?>"
                    class="btn btn-success btn-sm"><i class="fa fa-file-excel me-2"></i>Excel</a>
                <a href="<?=base_url('laporan/cetak?' . request()->getUri()->getQuery())?>" target="_blank"
                    class="btn btn-primary btn-sm"><i class="fa fa-print me-2"></i>Print</a>
            </div>
            <div class="collapse <?=(request()->getGet() != null) ? 'show' : ''?>" id="collapseFilter">
                <div class="card card-body mt-3">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ruangan" class="form-label">Ruangan</label>
                                    <select name="ruangan" id="ruangan" class="form-control">
                                        <option value="">Pilih Ruangan</option>
                                        <?php foreach ($ruangans as $ruangan): ?>
                                        <option value="<?=$ruangan->id_ruangan?>"
                                            <?=(request()->getGet('ruangan') == $ruangan->id_ruangan) ? 'selected' : ''?>>
                                            <?=$ruangan->nama_ruangan?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option <?=(request()->getGet('status') == 'Dipinjam') ? 'selected' : ''?>
                                            value="Dipinjam">Dipinjam</option>
                                        <option <?=(request()->getGet('status') == 'Dikembalikan') ? 'selected' : ''?>
                                            value="Dikembalikan">Dikembalikan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="text" name="tanggal" id="tanggal" class="form-control dateRange"
                                        value="<?=request()->getGet('tanggal')?>">
                                </div>
                                <div class="form-group">
                                    <!-- Filter User -->
                                    <label for="user" class="form-label">User</label>
                                    <select name="user" id="user" class="form-control">
                                        <option value="">Pilih User</option>
                                        <?php foreach ($users as $user): ?>
                                        <option value="<?=$user->id_user?>"
                                            <?=(request()->getGet('user') == $user->id_user) ? 'selected' : ''?>>
                                            <?=$user->nama?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3 gap-1">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="fa fa-circle-check me-2"></i>Filter</button>
                            <?php if (request()->getGet() != null): ?>
                            <a href="<?=base_url('laporan')?>" class="btn btn-danger btn-sm"><i
                                    class="fa fa-x me-2"></i>Reset</a>
                            <?php endif;?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($peminjamans as $peminjaman): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$peminjaman->nama;?></td>
                        <td><?=date('d-m-Y', strtotime($peminjaman->tgl_pinjam));?></td>
                        <td><?=date('d-m-Y', strtotime($peminjaman->tgl_kembali));?></td>
                        <td>
                            <?php if ($peminjaman->status_peminjaman == 'Dipinjam'): ?>
                            <span class="badge bg-warning">Dipinjam</span>
                            <?php else: ?>
                            <span class="badge bg-success">Dikembalikan</span>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection()?>