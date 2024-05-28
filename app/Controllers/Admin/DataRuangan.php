<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataRuangan extends BaseController
{

    protected $ruanganModel;

    public function __construct()
    {
        $this->ruanganModel = new \App\Models\RuanganModel();
    }

    public function index()
    {
        $data = [
            'ruangans' => $this->ruanganModel->findAll(),
        ];

        return view('pages/admin-operator/ruangan/index', $data);
    }

    // Tambah Ruangan
    public function tambahAction()
    {
        $foto = $this->request->getFile('foto_ruangan');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/ruangan/foto');
            $fotoName = $foto->getName();
        }
        $this->ruanganModel->save([
            'nama_ruangan' => $this->request->getPost('nama_ruangan'),
            'foto' => $fotoName,
        ]);

        return redirect()->to(base_url('data-ruangan'));
    }

    public function editAction($id_ruangan)
    {
        $foto = $this->request->getFile('foto_ruangan');
        $data = [
            'id_ruangan' => $id_ruangan,
            'nama_ruangan' => $this->request->getPost('nama_ruangan'),
        ];
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/ruangan/foto');
            $fotoName = $foto->getName();
            $data['foto'] = $fotoName;
        }
        $this->ruanganModel->save($data);

        return redirect()->to(base_url('data-ruangan'));
    }

    // Hapus Ruangan
    public function hapus($id_ruangan)
    {
        $ruangan = $this->ruanganModel->find($id_ruangan);
        if ($ruangan->foto != null && file_exists('uploads/ruangan/foto/' . $ruangan->foto)) {
            unlink('uploads/ruangan/foto/' . $ruangan->foto);
        }
        $this->ruanganModel->delete($id_ruangan);

        return redirect()->to(base_url('data-ruangan'));
    }

    // Export data to Excel
    public function exportToExcel()
    {
        //
        $data = $this->ruanganModel->findAll();
        //Init
        $spreadsheet = new Spreadsheet();
        // Header / Column Name
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama Ruangan');

        //Fill Data
        $rowIndex = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rowIndex, $no)
                ->setCellValue('B' . $rowIndex, $row->nama_ruangan);
            $rowIndex++;
            $no++;
        }

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Ruangan');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Ruangan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    // Import data from Excel
    public function importFromExcel()
    {

        $file = $this->request->getFile('file');

        if ($file) {
            $extension = $file->getClientExtension();

            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                return redirect()->to(base_url('data-ruangan'))->with('error', 'Invalid file type');
            }

            $spreadsheet = $reader->load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            foreach ($rows as $index => $row) {
                if ($index == 0) {
                    // Skip the first row (header)
                    continue;
                }

                // Assuming the columns are as follows:
                // A: kode_inventaris, B: nama, C: merek, D: spesifikasi, E: kondisi, F: jumlah, G: harga, H: sumber, I: nama_ruangan
                // Create associative array
                $data[] = [
                    'nama_ruangan' => $row[1],
                ];
            }
            // Save the data to the database
            //Bulk insert
            if (isset($data)) {
                $this->ruanganModel->insertBatch($data);
            }

            return redirect()->to(base_url('data-ruangan'))->with('success', 'Data imported successfully');
        } else {
            return redirect()->to(base_url('data-ruangan'))->with('error', 'No file selected');
        }

    }

    // Download the template
    public function downloadExcel()
    {
        //Init
        $spreadsheet = new Spreadsheet();
// Header / Column Name
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama Ruangan');

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Ruangan');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Ruangan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}