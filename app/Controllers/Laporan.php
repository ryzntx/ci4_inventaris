<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Laporan extends BaseController
{
    protected $ruanganModel, $peminjamanModel, $userModel, $detailPeminjamanModel;

    public function __construct()
    {
        // Load model
        $this->ruanganModel = new \App\Models\RuanganModel();
        $this->peminjamanModel = new \App\Models\PeminjamanModel();
        $this->userModel = new \App\Models\UserModel();
        $this->detailPeminjamanModel = new \App\Models\DetailPeminjamanModel();
    }

    public function index()
    {
        $data = [
            'ruangans' => $this->ruanganModel->findAll(),
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
            'users' => $this->userModel->findAll(),
        ];
        // check _get param
        if ($this->request->getGet('ruangan')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, null, $this->request->getGet('ruangan'));
        }
        // explode date range
        if ($this->request->getGet('tanggal')) {
            $tanggal = explode(' - ', $this->request->getGet('tanggal'));
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, $tanggal);
        }
        // check user
        if ($this->request->getGet('user')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, $this->request->getGet('user'));
        }
        // check status
        if ($this->request->getGet('status')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, $this->request->getGet('status'));
        }

        return view('pages/admin-operator/laporan/index', $data);
    }

    public function cetak()
    {
        $data = [
            'no' => 1,
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        // check ruangan
        if ($this->request->getGet('ruangan')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, null, $this->request->getGet('ruangan'));
        }
        // explode date range
        if ($this->request->getGet('tanggal')) {
            $tanggal = explode(' - ', $this->request->getGet('tanggal'));
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, $tanggal);
        }
        // check user
        if ($this->request->getGet('user')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, $this->request->getGet('user'));
        }
        // check status
        if ($this->request->getGet('status')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, $this->request->getGet('status'));
        }
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

        return view('pages/admin-operator/laporan/cetak', $data);
    }

    public function pdf()
    {
        $data = [
            'no' => 1,
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        // check ruangan
        if ($this->request->getGet('ruangan')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, null, $this->request->getGet('ruangan'));
        }
        // explode date range
        if ($this->request->getGet('tanggal')) {
            $tanggal = explode(' - ', $this->request->getGet('tanggal'));
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, $tanggal);
        }
        // check user
        if ($this->request->getGet('user')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, $this->request->getGet('user'));
        }
        // check status
        if ($this->request->getGet('status')) {
            $data['peminjamans'] = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, $this->request->getGet('status'));
        }
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
        $dompdf->loadHtml(view('pages/admin-operator/laporan/pdf', $data));
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
        // Filter Section
        // check ruangan
        if ($this->request->getGet('ruangan')) {
            $peminjamans = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, null, $this->request->getGet('ruangan'));
        }
        // explode date range
        if ($this->request->getGet('tanggal')) {
            $tanggal = explode(' - ', $this->request->getGet('tanggal'));
            $peminjamans = $this->peminjamanModel->ambilDataPeminjaman(null, null, $tanggal);
        }
        // check user
        if ($this->request->getGet('user')) {
            $peminjamans = $this->peminjamanModel->ambilDataPeminjaman(null, $this->request->getGet('user'));
        }
        // check status
        if ($this->request->getGet('status')) {
            $peminjamans = $this->peminjamanModel->ambilDataPeminjaman(null, null, null, $this->request->getGet('status'));
        }
        // End Filter Section
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