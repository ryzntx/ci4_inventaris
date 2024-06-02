<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apl Inventaris - Cetak Peminjaman</title>
        <link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Laporan Peminjaman Inventaris</h1>
                    <p class="text-center">Tanggal <?=date('Y-m-d')?></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="align-middle text-center">
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Status</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Nama Inventaris</th>
                                <th>Nama Ruangan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($peminjamans as $key => $val): ?>
                            <?php foreach ($val->detail_peminjamans as $k => $v): ?>
                            <tr>
                                <?php if ($k == 0): ?>
                                <td rowspan="<?=count($val->detail_peminjamans)?>"><?=$no++?></td>
                                <td rowspan="<?=count($val->detail_peminjamans)?>"><?=$val->nama?></td>
                                <td rowspan="<?=count($val->detail_peminjamans)?>"><?=$val->status_peminjaman?></td>
                                <td rowspan="<?=count($val->detail_peminjamans)?>">
                                    <?=date('d-m-Y', strtotime($val->tgl_pinjam))?></td>
                                <td rowspan="<?=count($val->detail_peminjamans)?>">
                                    <?=date('d-m-Y', strtotime($val->tgl_kembali))?></td>
                                <?php endif;?>
                                <td><?=$v->nama?></td>
                                <td><?=$v->nama_ruangan?></td>
                                <td><?=$v->jumlah?></td>
                            </tr>
                            <?php endforeach;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script>
        window.print();
        </script>
    </body>

</html>