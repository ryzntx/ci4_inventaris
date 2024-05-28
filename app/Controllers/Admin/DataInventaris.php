<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataInventaris extends BaseController
{
    protected $inventarisModel, $ruanganModel;

    public function __construct()
    {
        $this->inventarisModel = new \App\Models\InventarisModel();
        $this->ruanganModel = new \App\Models\RuanganModel();
    }

    public function index()
    {
        $data = [
            'inventariss' => $this->inventarisModel->getInventaris(),
        ];

        return view('pages/admin-operator/data-inventaris/index', $data);
    }

    public function tambah()
    {
        $data = [
            'ruangans' => $this->ruanganModel->findAll(),
        ];

        return view('pages/admin-operator/data-inventaris/tambah', $data);
    }

    public function tambahAction()
    {
        $foto = $this->request->getFile('foto');

        $data = [
            'kode_inventaris' => $this->request->getPost('kode_inventaris'),
            'nama' => $this->request->getPost('nama'),
            'merek' => $this->request->getPost('merek'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kondisi' => $this->request->getPost('kondisi'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'sumber' => $this->request->getPost('sumber'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'id_user' => session()->get('id_user'),
        ];

        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/inventaris/foto');
            $fotoName = $foto->getName();
            $data['foto'] = $fotoName;
        }

        $this->inventarisModel->insert($data);

        return redirect()->to(base_url('data-inventaris'));
    }

    public function edit($id_inventaris)
    {
        $data = [
            'inventaris' => $this->inventarisModel->getInventarisById($id_inventaris),
            'ruangans' => $this->ruanganModel->findAll(),
        ];

        return view('pages/admin-operator/data-inventaris/edit', $data);
    }

    public function editAction($id_inventaris)
    {
        $foto = $this->request->getFile('foto');
        $inventaris = $this->inventarisModel->getInventarisById($id_inventaris);

        $data = [
            'kode_inventaris' => $this->request->getPost('kode_inventaris'),
            'nama' => $this->request->getPost('nama'),
            'merek' => $this->request->getPost('merek'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kondisi' => $this->request->getPost('kondisi'),
            'jumlah' => $this->request->getPost('jumlah'),
            'harga' => $this->request->getPost('harga'),
            'sumber' => $this->request->getPost('sumber'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'id_user' => session()->get('id_user'),
        ];

        if ($foto->isValid() && !$foto->hasMoved()) {
            if ($inventaris->foto != null && file_exists('uploads/inventaris/foto/' . $inventaris->foto)) {
                unlink('uploads/inventaris/foto/' . $inventaris->foto);
            }
            $foto->move('uploads/inventaris/foto');
            $fotoName = $foto->getName();
            $data['foto'] = $fotoName;
        }

        $this->inventarisModel->update($id_inventaris, $data);

        return redirect()->to(base_url('data-inventaris'));
    }

    public function hapus($id_inventaris)
    {
        $inventaris = $this->inventarisModel->getInventarisById($id_inventaris);
        if ($inventaris->foto != null && file_exists('uploads/inventaris/foto/' . $inventaris->foto)) {
            unlink('uploads/inventaris/foto/' . $inventaris->foto);
        }
        $this->inventarisModel->delete($id_inventaris);

        return redirect()->to(base_url('data-inventaris'));
    }

    // Export data to Excel
    public function exportToExcel()
    {
        //
        $data = $this->inventarisModel->getInventaris();
        //Init
        $spreadsheet = new Spreadsheet();
        // Header / Column Name
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Kode Inventaris')
            ->setCellValue('C1', 'Nama')
            ->setCellValue('D1', 'Merek')
            ->setCellValue('E1', 'Spesifikasi')
            ->setCellValue('F1', 'Kondisi')
            ->setCellValue('G1', 'Jumlah')
            ->setCellValue('H1', 'Harga')
            ->setCellValue('I1', 'Sumber')
            ->setCellValue('J1', 'Ruangan');

        //Fill Data
        $rowIndex = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rowIndex, $no)
                ->setCellValue('B' . $rowIndex, $row->kode_inventaris)
                ->setCellValue('C' . $rowIndex, $row->nama)
                ->setCellValue('D' . $rowIndex, $row->merek)
                ->setCellValue('E' . $rowIndex, $row->spesifikasi)
                ->setCellValue('F' . $rowIndex, $row->kondisi)
                ->setCellValue('G' . $rowIndex, $row->jumlah)
                ->setCellValue('H' . $rowIndex, $row->harga)
                ->setCellValue('I' . $rowIndex, $row->sumber)
                ->setCellValue('J' . $rowIndex, $row->nama_ruangan);
            $rowIndex++;
            $no++;
        }

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Inventaris');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Inventaris.xlsx"');
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
                return redirect()->to(base_url('data-inventaris'))->with('error', 'Invalid file type');
            }

            $spreadsheet = $reader->load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            foreach ($rows as $index => $row) {
                if ($index == 0) {
                    // Skip the first row (header)
                    continue;
                }

                // Find nama_ruangan by name
                $ruangan = $this->ruanganModel->where('nama_ruangan', $row[9])->first();
                if (!$ruangan) {
                    // Skip the row if the ruangan is not found
                    continue;
                }

                // Assuming the columns are as follows:
                // A: kode_inventaris, B: nama, C: merek, D: spesifikasi, E: kondisi, F: jumlah, G: harga, H: sumber, I: nama_ruangan
                // Create associative array
                $data[] = [
                    'kode_inventaris' => $row[1],
                    'nama' => $row[2],
                    'merek' => $row[3],
                    'spesifikasi' => $row[4],
                    'kondisi' => $row[5],
                    'jumlah' => $row[6],
                    'harga' => $row[7],
                    'sumber' => $row[8],
                    'id_ruangan' => $ruangan->id_ruangan,
                    'id_user' => session()->get('id_user'),
                ];
            }
            // Save the data to the database
            //Bulk insert
            $this->inventarisModel->insertBatch($data);

            return redirect()->to(base_url('data-inventaris'))->with('success', 'Data imported successfully');
        } else {
            return redirect()->to(base_url('data-inventaris'))->with('error', 'No file selected');
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
            ->setCellValue('B1', 'Kode Inventaris')
            ->setCellValue('C1', 'Nama')
            ->setCellValue('D1', 'Merek')
            ->setCellValue('E1', 'Spesifikasi')
            ->setCellValue('F1', 'Kondisi')
            ->setCellValue('G1', 'Jumlah')
            ->setCellValue('H1', 'Harga')
            ->setCellValue('I1', 'Sumber')
            ->setCellValue('J1', 'Ruangan');

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Inventaris');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Inventaris.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

}
