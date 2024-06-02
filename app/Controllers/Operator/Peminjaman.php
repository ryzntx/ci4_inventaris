<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Peminjaman extends BaseController
{
    protected $peminjamanModel, $detailPeminjamanModel, $userModel, $inventarisModel;

    public function __construct()
    {
        $this->peminjamanModel = new \App\Models\PeminjamanModel();
        $this->detailPeminjamanModel = new \App\Models\DetailPeminjamanModel();
        $this->userModel = new \App\Models\UserModel();
        $this->inventarisModel = new \App\Models\InventarisModel();
    }

    public function index()
    {
        $data = [
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        if (session()->has('keranjang')) {
            $data['keranjang'] = session()->get('keranjang');
        }

        return view('pages/admin-operator/peminjaman/index', $data);
    }

    public function tambah()
    {
        $data = [
            'users' => $this->userModel->findAll(),
            'inventariss' => $this->inventarisModel->getInventaris(),
        ];

        return view('pages/admin-operator/peminjaman/tambah', $data);
    }

    public function tambahItemKeranjang()
    {
        //
        $id_inventaris = $this->request->getVar('id_inventaris');
        $kode_inventaris = $this->request->getVar('kode_inventaris');
        $nama = $this->request->getVar('nama');
        $jumlah = $this->request->getVar('jumlah');
        $row_id = md5($nama . serialize($jumlah));

        $data = [
            $row_id => [
                'id_inventaris' => $id_inventaris,
                'kode_inventaris' => $kode_inventaris,
                'nama' => $nama,
                'jumlah' => $jumlah,
                'row_id' => $row_id,
            ],
        ];

        if (!session()->has('keranjang')) {
            session()->set('keranjang', $data);
        } else {
            $exist = 0;
            $keranjang = session()->get('keranjang');
            //
            foreach ($keranjang as $i => $item) {
                if ($keranjang[$i]['nama'] == $nama) {
                    $keranjang[$i]['jumlah'] += $jumlah;
                    $exist++;
                }
            }
            if ($exist == 0) {
                $keranjang_baru = array_merge_recursive($keranjang, $data);
                session()->set('keranjang', $keranjang_baru);
            } else {
                session()->set('keranjang', $keranjang);
            }
        }
        return redirect()->to('/peminjaman/tambah')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function hapusItemKeranjang($row_id)
    {
        $keranjang_baru = session()->get('keranjang');
        foreach ($keranjang_baru as $index => $item) {
            if ($keranjang_baru[$index]['row_id'] == $row_id) {
                unset($keranjang_baru[$index]);
            }
        }
        if (count($keranjang_baru) == 0) {
            session()->remove('keranjang');
            return redirect()->to('/peminjaman/tambah')->with('success', 'Item berhasil dihapus dari keranjang');
        } else {
            session()->set('keranjang', $keranjang_baru);
            return redirect()->to('/peminjaman/tambah')->with('success', 'Item berhasil dihapus dari keranjang');
        }
    }

    public function hapusKeranjang()
    {
        session()->remove('keranjang');
        return redirect()->to('/peminjaman/tambah')->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function tambahAction()
    {
        //todo: pengurangan item inventaris
        $data = [
            'id_user' => session()->get('id_user'),
            'tgl_pinjam' => $this->request->getVar('tanggal_peminjaman'),
            'tgl_kembali' => $this->request->getVar('tanggal_pengembalian'),
            'status_peminjaman' => 'Dipinjam',
        ];

        $res = $this->peminjamanModel->save($data);
        $id_peminjaman = $this->peminjamanModel->insertID();

        $keranjang = session()->get('keranjang');
        foreach ($keranjang as $item) {
            // Simpan detail peminjaman
            $data_detail = [
                'id_peminjaman' => $id_peminjaman,
                'id_inventaris' => $item['id_inventaris'],
                'jumlah' => $item['jumlah'],
            ];
            $res = $this->detailPeminjamanModel->save($data_detail);
            // Pengurangan item inventaris
            $cari_inventaris = $this->inventarisModel->find($item['id_inventaris']);
            $data_inventaris = [
                'jumlah' => $cari_inventaris->jumlah - $item['jumlah'],
            ];
            $this->inventarisModel->update($item['id_inventaris'], $data_inventaris);

        }

        if ($res) {
            session()->remove('keranjang');
            return redirect()->to('/peminjaman')->with('success', 'Data Peminjaman berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data Peminjaman gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $data = [
            'peminjaman' => $this->peminjamanModel->find($id),
            'users' => $this->userModel->findAll(),
            'inventariss' => $this->inventarisModel->getInventaris(),
            'detail_peminjaman' => $this->detailPeminjamanModel->getDetailPeminjaman($id),
        ];

        return view('pages/admin-operator/peminjaman/edit', $data);
    }

    public function editAction($id)
    {
        $data = [
            'tgl_pinjam' => $this->request->getVar('tanggal_peminjaman'),
            'tgl_kembali' => $this->request->getVar('tanggal_pengembalian'),
            'status_peminjaman' => $this->request->getVar('status_peminjaman'),
        ];

        // if ($this->request->getVar('status_peminjaman') == 'Dipinjam') {
        //     //todo: pengurangan item inventaris
        //     $detail_peminjaman = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id);
        //     foreach ($detail_peminjaman as $item) {
        //         $cari_inventaris = $this->inventarisModel->find($item->id_inventaris);
        //         $data_inventaris = [
        //             'jumlah' => $cari_inventaris->jumlah - $item->jumlah,
        //         ];
        //         $this->inventarisModel->update($item->id_inventaris, $data_inventaris);

        //     }
        // }
        if ($this->request->getVar('status_peminjaman') == 'Dikembalikan' || $this->request->getVar('status_peminjaman') == 'Pinjaman Ditolak') {
            //todo: penambahan item inventaris
            $detail_peminjaman = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id);
            foreach ($detail_peminjaman as $item) {
                $cari_inventaris = $this->inventarisModel->find($item->id_inventaris);
                $data_inventaris = [
                    'jumlah' => $cari_inventaris->jumlah + $item->jumlah,
                ];
                $this->inventarisModel->update($item->id_inventaris, $data_inventaris);
            }
        }

        $res = $this->peminjamanModel->update($id, $data);
        if ($res) {
            return redirect()->to('/peminjaman')->with('success', 'Data Peminjaman berhasil diubah');
        } else {
            return redirect()->to('/peminjaman')->with('error', 'Data Peminjaman gagal diubah');
        }
    }

    public function hapus($id)
    {
        //todo: pengembalian item inventaris
        $res = $this->detailPeminjamanModel->hapusDetailPeminjaman($id);
        $res = $this->peminjamanModel->delete($id);
        if ($res) {
            return redirect()->to('/peminjaman')->with('success', 'Data Peminjaman berhasil dihapus');
        } else {
            return redirect()->to('/peminjaman')->with('error', 'Data Peminjaman gagal dihapus');
        }

    }

    public function lihat($id)
    {
        $data = [
            'peminjaman' => $this->peminjamanModel->find($id),
            'detail_peminjaman' => $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id),
        ];

        return view('pages/admin-operator/peminjaman/lihat', $data);
    }

    public function cetak()
    {
        $data = [
            'no' => 1,
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        // get detail peminjaman
        $arr = [];
        foreach ($data['peminjamans'] as $peminjaman) {
            $detail_peminjamans = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($peminjaman->id_peminjaman);
            // merge detail peminjaman and peminjaman
            $peminjaman->detail_peminjamans = $detail_peminjamans;
            // push to array
            $arr[$peminjaman->id_peminjaman] = $peminjaman;
        }
        $data['peminjamans'] = $arr;

        return view('pages/admin-operator/peminjaman/cetak', $data);
    }

    public function pdf()
    {
        $data = [
            'no' => 1,
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        // get detail peminjaman
        $arr = [];
        foreach ($data['peminjamans'] as $peminjaman) {
            $detail_peminjamans = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($peminjaman->id_peminjaman);
            // merge detail peminjaman and peminjaman
            $peminjaman->detail_peminjamans = $detail_peminjamans;
            // push to array
            $arr[$peminjaman->id_peminjaman] = $peminjaman;
        }

        $data['peminjamans'] = $arr;
        // Dompdf
        $timestamp = date('Y-m-d H:i:s');
        $dompdf = new Dompdf(['isPhpEnabled' => true, 'isJavascriptEnabled' => true, 'chroot' => ROOTPATH, 'defaultFont' => 'sans-serif']);
        $dompdf->loadHtml(view('pages/admin-operator/peminjaman/pdf', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        return $dompdf->stream('laporan-peminjaman-' . $timestamp . '.pdf');
    }

    public function excel()
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        // Set document properties
        $sheet = $spreadsheet->getActiveSheet();
        // Set title
        $sheet->setTitle('Laporan Peminjaman Inventaris');
        // Set Header Title Sheet
        $sheet->setCellValue('A1', 'Laporan Peminjaman Inventaris')->mergeCells('A1:H1')->getStyle('A1')->getAlignment()->setVertical('center')->setHorizontal('center');
        $sheet->setCellValue('A2', 'Tanggal ' . date('Y-m-d'))->mergeCells('A2:H2')->getStyle('A2')->getAlignment()->setVertical('center')->setHorizontal('center');
        // Set header
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Peminjam');
        $sheet->setCellValue('C4', 'Tanggal Pinjam');
        $sheet->setCellValue('D4', 'Tanggal Kembali');
        $sheet->setCellValue('E4', 'Status');
        $sheet->setCellValue('F4', 'Nama Inventaris');
        $sheet->setCellValue('G4', 'Nama Ruangan');
        $sheet->setCellValue('H4', 'Jumlah');
        // Get data
        $no = 1;
        $peminjamans = $this->peminjamanModel->ambilDataPeminjaman();

        // get detail peminjaman
        $arr = [];
        foreach ($peminjamans as $peminjaman) {
            $detail_peminjamans = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($peminjaman->id_peminjaman);
            // merge detail peminjaman and peminjaman
            $peminjaman->detail_peminjamans = $detail_peminjamans;
            // push to array
            $arr[$peminjaman->id_peminjaman] = $peminjaman;
        }
        $peminjamans = $arr;

        // Set data
        $row = 5;
        foreach ($peminjamans as $index => $peminjaman) {
            foreach ($peminjaman->detail_peminjamans as $key => $detail_peminjaman) {
                $sheet->setCellValue('A' . $row, $no)
                    ->mergeCells('A' . $row . ':A' . ($row + count($peminjaman->detail_peminjamans) - 1))
                    ->getStyle('A' . $row)->getAlignment()->setVertical('center')->setHorizontal('center');
                $sheet->setCellValue('B' . $row, $peminjaman->nama)
                    ->mergeCells('B' . $row . ':B' . ($row + count($peminjaman->detail_peminjamans) - 1))
                    ->getStyle('B' . $row)->getAlignment()->setVertical('center')->setHorizontal('center');
                $sheet->setCellValue('C' . $row, date('d-m-Y', strtotime($peminjaman->tgl_pinjam)))
                    ->mergeCells('C' . $row . ':C' . ($row + count($peminjaman->detail_peminjamans) - 1))
                    ->getStyle('C' . $row)->getAlignment()->setVertical('center')->setHorizontal('center');
                $sheet->setCellValue('D' . $row, date('d-m-Y', strtotime($peminjaman->tgl_kembali)))
                    ->mergeCells('D' . $row . ':D' . ($row + count($peminjaman->detail_peminjamans) - 1))
                    ->getStyle('D' . $row)->getAlignment()->setVertical('center')->setHorizontal('center');
                $sheet->setCellValue('E' . $row, $peminjaman->status_peminjaman)
                    ->mergeCells('E' . $row . ':E' . ($row + count($peminjaman->detail_peminjamans) - 1))
                    ->getStyle('E' . $row)->getAlignment()->setVertical('center')->setHorizontal('center');
                $sheet->setCellValue('F' . $row, $detail_peminjaman->nama);
                $sheet->setCellValue('G' . $row, $detail_peminjaman->nama_ruangan);
                $sheet->setCellValue('H' . $row, $detail_peminjaman->jumlah);
                $row++;
            }
            $no++;
        }
        // Set auto size
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        // Set header style
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A4:H4')->getFont()->setBold(true);
        $sheet->getStyle('A4:H4')->getAlignment()->setHorizontal('center');
        // Set border
        $sheet->getStyle('A4:H' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle('thin');
        // Set filename
        $timestamp = date('Y-m-d H:i:s');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="laporan-peminjaman-' . $timestamp . '.xlsx"');
        header('Cache-Control: max-age=0');
        return $writer->save('php://output');
    }
}