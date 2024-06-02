<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ManajemenAkun extends BaseController
{
    protected $userModel;
    protected $levelModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->levelModel = new \App\Models\LevelModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Akun',
            'users' => $this->userModel->getUsers(),
        ];

        return view('pages/admin-operator/manajemen-akun/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Akun',
            'levels' => $this->levelModel->findAll(),
        ];

        return view('pages/admin-operator/manajemen-akun/tambah', $data);
    }

    public function tambahAction()
    {
        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/foto');
            $fotoName = $foto->getName();
        }
        $res = $this->userModel->save([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_level' => $this->request->getPost('id_level'),
            'foto' => $fotoName ?? 'default.jpg',
        ]);

        if ($res):
            return redirect()->to(base_url('manajemen-akun'))->with('success', 'Akun berhasil ditambahkan');
        else:
            return redirect()->to(base_url('manajemen-akun'))->with('error', 'Akun gagal ditambahkan');
        endif;
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Akun',
            'user' => $this->userModel->joinLevelWhere($id),
            'levels' => $this->levelModel->findAll(),
        ];

        return view('pages/admin-operator/manajemen-akun/edit', $data);
    }

    public function editAction($id)
    {
        $foto = $this->request->getFile('foto');
        $user = $this->userModel->find($id);
        $data = [
            'id_user' => $id,
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'id_level' => $this->request->getPost('id_level'),
            'status' => $this->request->getPost('status'),
        ];
        if ($foto->isValid() && !$foto->hasMoved()) {
            if ($user->foto != null && $user->foto != 'default.jpg' && file_exists('uploads/foto/' . $user->foto)) {
                unlink('uploads/foto/' . $user->foto);
            }
            $foto->move('uploads/foto');
            $fotoName = $foto->getName();
            $data['foto'] = $fotoName;
        }
        $res = $this->userModel->save($data);
        if ($res):
            return redirect()->to(base_url('manajemen-akun'))->with('success', 'Akun berhasil diubah');
        else:
            return redirect()->to(base_url('manajemen-akun'))->with('error', 'Akun gagal diubah');
        endif;
    }

    public function hapus($id)
    {
        $user = $this->userModel->find($id);
        if ($user->foto != null && $user->foto != 'default.jpg' && file_exists('uploads/foto/' . $user->foto)) {
            unlink('uploads/foto/' . $user->foto);
        }
        $res = $this->userModel->delete($id);
        if ($res):
            return redirect()->to(base_url('manajemen-akun'))->with('success', 'Akun berhasil dihapus');
        else:
            return redirect()->to(base_url('manajemen-akun'))->with('error', 'Akun gagal dihapus');
        endif;
    }

    // Export data to Excel
    public function exportToExcel()
    {
        //
        $data = $this->userModel->getUsers();
        //Init
        $spreadsheet = new Spreadsheet();
        // Header / Column Name
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Username')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Password')
            ->setCellValue('F1', 'Level');

        //Fill Data
        $rowIndex = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rowIndex, $no)
                ->setCellValue('B' . $rowIndex, $row->nama)
                ->setCellValue('C' . $rowIndex, $row->username)
                ->setCellValue('D' . $rowIndex, $row->email)
                ->setCellValue('E' . $rowIndex, 'secret')
                ->setCellValue('F' . $rowIndex, $row->nama_level);
            $rowIndex++;
            $no++;
        }

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Akun');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Akun.xlsx"');
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
                return redirect()->to(base_url('manajemen-akun'))->with('error', 'Tipe file tidak valid');
            }

            $spreadsheet = $reader->load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            foreach ($rows as $index => $row) {
                if ($index == 0) {
                    // Skip the first row (header)
                    continue;
                }

                // Find level by name
                $level = $this->levelModel->where('nama_level', $row[5])->first();
                if (!$level) {
                    continue;
                }

                // Check username not duplicate
                $user = $this->userModel->where('username', $row[2])->first();
                if ($user) {
                    continue;
                }

                // Create associative array
                $data[] = [
                    'nama' => $row[1],
                    'username' => $row[2],
                    'email' => $row[3],
                    'password' => password_hash($row[4], PASSWORD_BCRYPT),
                    'id_level' => $level->id_level,
                ];
            }
            // Save the data to the database
            //Bulk insert
            if (isset($data)) {
                $res = $this->userModel->insertBatch($data);
            }
            if ($res):
                return redirect()->to(base_url('manajemen-akun'))->with('success', 'Data berhasil diimport');
            else:
                return redirect()->to(base_url('manajemen-akun'))->with('error', 'Data gagal diimport');
            endif;
        } else {
            return redirect()->to(base_url('manajemen-akun'))->with('error', 'Tidak ada file yang dipilih!');
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
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Username')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Password')
            ->setCellValue('F1', 'Level');

        // Set Title
        $spreadsheet->getActiveSheet()->setTitle('Data Akun');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Akun.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}