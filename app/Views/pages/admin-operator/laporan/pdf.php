<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apl Inventaris - Cetak PDF Laporan</title>
        <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            margin: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
        }
        </style>
    </head>

    <body>
        <div>
            <div>
                <div>
                    <h1>Laporan Peminjaman Inventaris</h1>
                    <p>Tanggal <?=date('Y-m-d')?></p>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
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
    </body>

</html>