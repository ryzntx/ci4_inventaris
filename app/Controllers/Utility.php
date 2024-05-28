<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Ifsnop\Mysqldump\Mysqldump;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Utility extends BaseController
{
    public function index()
    {
        $folderPath = 'database/';

        $data = [
            'files' => $this->getAllFilesFromFolder($folderPath),
            'latestFile' => $this->getLatestFileFromFolder($folderPath),
            'latestFileTimestamp' => $this->getFileTimestamp($folderPath . $this->getLatestFileFromFolder($folderPath)),
        ];

        // dd($data);

        return view('pages/utility/index', $data);
    }

    public function databaseDump()
    {
        $dumpSettings = [
            // 'include-tables' => array(),
            // 'exclude-tables' => array(),
            // 'init_commands' => array(),
            // 'no-data' => array(),
            'if-not-exists' => false,
            'reset-auto-increment' => false,
            'add-drop-database' => false,
            'add-drop-table' => false,
            'add-drop-trigger' => true,
            'add-locks' => true,
            'complete-insert' => false,
            'databases' => false,
            'default-character-set' => Mysqldump::UTF8,
            'disable-keys' => true,
            'extended-insert' => true,
            'events' => false,
            'hex-blob' => true, /* faster than escaped content */
            'insert-ignore' => false,
            'no-autocommit' => true,
            'no-create-db' => false,
            'no-create-info' => false,
            'lock-tables' => true,
            'routines' => false,
            'single-transaction' => true,
            'skip-triggers' => false,
            'skip-tz-utc' => false,
            'skip-comments' => false,
            'skip-dump-date' => false,
            'skip-definer' => false,
            'where' => '',
        ];
        try {
            $timestamp = date('Y-m-d_H-i-s');

            $dump = new Mysqldump('mysql:host=localhost;dbname=ci4_inventaris;port=3306', 'root', '', $dumpSettings);
            $dump->start('database/backup_' . $timestamp . '.sql');
            $filename = 'backup_' . $timestamp . '.sql';
            session()->setFlashdata('file', $filename);
            return redirect()->back()->with('success', 'Database berhasil di backup!');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Database gagal di backup!, Mysqldump: ' . $e->getMessage());
        }
    }

    public function tableDump($tableName)
    {
        $dumpSettings = [
            'include-tables' => array($tableName),
            // 'exclude-tables' => array(),
            // 'init_commands' => array(),
            // 'no-data' => array(),
            'if-not-exists' => false,
            'reset-auto-increment' => false,
            'add-drop-database' => false,
            'add-drop-table' => false,
            'add-drop-trigger' => true,
            'add-locks' => true,
            'complete-insert' => false,
            'databases' => false,
            'default-character-set' => Mysqldump::UTF8,
            'disable-keys' => true,
            'extended-insert' => true,
            'events' => false,
            'hex-blob' => true, /* faster than escaped content */
            'insert-ignore' => false,
            'no-autocommit' => true,
            'no-create-db' => false,
            'no-create-info' => false,
            'lock-tables' => true,
            'routines' => false,
            'single-transaction' => true,
            'skip-triggers' => false,
            'skip-tz-utc' => false,
            'skip-comments' => false,
            'skip-dump-date' => false,
            'skip-definer' => false,
            'where' => '',
        ];
        try {
            $timestamp = date('Y-m-d_H-i-s');

            $dump = new Mysqldump('mysql:host=localhost;dbname=ci4_inventaris;port=3306', 'root', '', $dumpSettings);
            $dump->start('database/backup_' . $timestamp . '.sql');

            $path = "database/backup_" . $timestamp . ".sql";
            return redirect()->back()->with('success', 'Database berhasil di backup!');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Database gagal di backup! ' . $e->getMessage());
        }
    }

    public function dumpDatabaseToExcel()
    {
        //Get Data
        $ruangan = model('RuanganModel')->findAll();
        $inventaris = model('InventarisModel')->findAll();
        $level = model('LevelModel')->findAll();
        $user = model('UserModel')->findAll();
        $peminjaman = model('PeminjamanModel')->findAll();
        $detailPeminjaman = model('DetailPeminjamanModel')->findAll();
        //Init
        $spreadsheet = new Spreadsheet();

        // Create a new Worksheet
        $sheetRuangan = $spreadsheet->getActiveSheet();
        $sheetInventaris = $spreadsheet->createSheet();
        $sheetLevel = $spreadsheet->createSheet();
        $sheetUser = $spreadsheet->createSheet();
        $sheetPeminjaman = $spreadsheet->createSheet();
        $sheetDetailPeminjaman = $spreadsheet->createSheet();

        // Header / Column Name Data Ruangan
        $sheetRuangan
            ->setCellValue('A1', 'id_ruangan')
            ->setCellValue('B1', 'Nama Ruangan')
            ->setTitle('Data Ruangan');

        // Header / Column Name Data Inventaris
        $sheetInventaris
            ->setCellValue('A1', 'id_inventaris')
            ->setCellValue('B1', 'Kode Inventaris')
            ->setCellValue('C1', 'Nama')
            ->setCellValue('D1', 'Merek')
            ->setCellValue('E1', 'Spesifikasi')
            ->setCellValue('F1', 'Kondisi')
            ->setCellValue('G1', 'Jumlah')
            ->setCellValue('H1', 'Harga')
            ->setCellValue('I1', 'Sumber')
            ->setCellValue('J1', 'id_ruangan')
            ->setTitle('Data Inventaris');

        // Header / Column Name Data Level
        $sheetLevel
            ->setCellValue('A1', 'id_level')
            ->setCellValue('B1', 'Nama Level')
            ->setTitle('Data Level');

        // Header / Column Name Data User
        $sheetUser
            ->setCellValue('A1', 'id_user')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Username')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Password')
            ->setCellValue('F1', 'id_level')
            ->setTitle('Data User');

        // Header / Column Name Data Peminjaman
        $sheetPeminjaman
            ->setCellValue('A1', 'id_peminjaman')
            ->setCellValue('B1', 'Tanggal Pinjam')
            ->setCellValue('C1', 'Tanggal Kembali')
            ->setCellValue('D1', 'Status')
            ->setCellValue('E1', 'id_user')
            ->setTitle('Data Peminjaman');

        // Header / Column Name Data Detail Peminjaman
        $sheetDetailPeminjaman
            ->setCellValue('A1', 'id_detail_peminjaman')
            ->setCellValue('B1', 'id_inventaris')
            ->setCellValue('C1', 'id_peminjaman')
            ->setCellValue('D1', 'Jumlah')
            ->setTitle('Data Detail Peminjaman');

        // Fill Data Ruangan
        $rowIndex = 2;
        foreach ($ruangan as $row) {
            $sheetRuangan
                ->setCellValue('A' . $rowIndex, $row->id_ruangan)
                ->setCellValue('B' . $rowIndex, $row->nama_ruangan);
            $rowIndex++;
        }

        //Fill Data Inventaris
        $rowIndex = 2;
        foreach ($inventaris as $row) {
            $sheetInventaris
                ->setCellValue('A' . $rowIndex, $row->id_inventaris)
                ->setCellValue('B' . $rowIndex, $row->kode_inventaris)
                ->setCellValue('C' . $rowIndex, $row->nama)
                ->setCellValue('D' . $rowIndex, $row->merek)
                ->setCellValue('E' . $rowIndex, $row->spesifikasi)
                ->setCellValue('F' . $rowIndex, $row->kondisi)
                ->setCellValue('G' . $rowIndex, $row->jumlah)
                ->setCellValue('H' . $rowIndex, $row->harga)
                ->setCellValue('I' . $rowIndex, $row->sumber)
                ->setCellValue('J' . $rowIndex, $row->id_ruangan);
            $rowIndex++;
        }

        //Fill Data Level
        $rowIndex = 2;
        foreach ($level as $row) {
            $sheetLevel
                ->setCellValue('A' . $rowIndex, $row->id_level)
                ->setCellValue('B' . $rowIndex, $row->nama_level);
            $rowIndex++;
        }

        //Fill Data User
        $rowIndex = 2;
        foreach ($user as $row) {
            $sheetUser
                ->setCellValue('A' . $rowIndex, $row->id_user)
                ->setCellValue('B' . $rowIndex, $row->nama)
                ->setCellValue('C' . $rowIndex, $row->username)
                ->setCellValue('D' . $rowIndex, $row->email)
                ->setCellValue('E' . $rowIndex, $row->password)
                ->setCellValue('F' . $rowIndex, $row->id_level);
            $rowIndex++;
        }

        //Fill Data Peminjaman
        $rowIndex = 2;
        foreach ($peminjaman as $row) {
            $sheetPeminjaman
                ->setCellValue('A' . $rowIndex, $row->id_peminjaman)
                ->setCellValue('B' . $rowIndex, $row->tgl_pinjam)
                ->setCellValue('C' . $rowIndex, $row->tgl_kembali)
                ->setCellValue('D' . $rowIndex, $row->status_peminjaman)
                ->setCellValue('E' . $rowIndex, $row->id_user);
            $rowIndex++;
        }

        //Fill Data Detail Peminjaman
        $rowIndex = 2;
        foreach ($detailPeminjaman as $row) {
            $sheetDetailPeminjaman
                ->setCellValue('A' . $rowIndex, $row->id_detail_peminjamans)
                ->setCellValue('B' . $rowIndex, $row->id_inventaris)
                ->setCellValue('C' . $rowIndex, $row->id_peminjaman)
                ->setCellValue('D' . $rowIndex, $row->jumlah);
            $rowIndex++;
        }

        // Get current date and time
        $timestamp = date('Y-m-d_H-i-s');

        // Set the file name
        $filename = 'backup_' . $timestamp . '.xlsx';

        // Save Excel 2007 file
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('database/' . $filename);

        // Redirect output to a client’s web browser (Xlsx)
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="Data Inventaris.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');

        session()->setFlashdata('file', $filename);
        return redirect()->back()->with('success', 'Database berhasil di backup ke Excel!');

    }

    public function restoreFromExcel($filename)
    {
        // Get File
        $filePath = 'database/' . $filename;
        // Check if file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }

        try {
            // Load Excel file
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($filePath);

            // Get Worksheet
            $sheetRuangan = $spreadsheet->getSheetByName('Data Ruangan');
            $sheetInventaris = $spreadsheet->getSheetByName('Data Inventaris');
            $sheetLevel = $spreadsheet->getSheetByName('Data Level');
            $sheetUser = $spreadsheet->getSheetByName('Data User');
            $sheetPeminjaman = $spreadsheet->getSheetByName('Data Peminjaman');
            $sheetDetailPeminjaman = $spreadsheet->getSheetByName('Data Detail Peminjaman');

            // Get Data
            $dataRuangan = $sheetRuangan->toArray();
            $dataInventaris = $sheetInventaris->toArray();
            $dataLevel = $sheetLevel->toArray();
            $dataUser = $sheetUser->toArray();
            $dataPeminjaman = $sheetPeminjaman->toArray();
            $dataDetailPeminjaman = $sheetDetailPeminjaman->toArray();

            // Disable foreign key checks
            $db = \Config\Database::connect();
            $db->query('SET FOREIGN_KEY_CHECKS = 0');

            // Truncate Table
            model('DetailPeminjamanModel')->truncate();
            model('PeminjamanModel')->truncate();
            model('InventarisModel')->truncate();
            model('RuanganModel')->truncate();
            model('UserModel')->truncate();
            model('LevelModel')->truncate();

            // Enable foreign key checks
            // $db->query('SET FOREIGN_KEY_CHECKS = 1');

            // Insert Data Ruangan
            foreach ($dataRuangan as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('RuanganModel')->insert([
                    'id_ruangan' => $row[0],
                    'nama_ruangan' => $row[1],
                ]);
            }

            // Insert Data Inventaris
            foreach ($dataInventaris as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('InventarisModel')->insert([
                    'id_inventaris' => $row[0],
                    'kode_inventaris' => $row[1],
                    'nama' => $row[2],
                    'merek' => $row[3],
                    'spesifikasi' => $row[4],
                    'kondisi' => $row[5],
                    'jumlah' => $row[6],
                    'harga' => $row[7],
                    'sumber' => $row[8],
                    'id_ruangan' => $row[9],
                ]);
            }

            // Insert Data Level
            foreach ($dataLevel as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('LevelModel')->insert([
                    'id_level' => $row[0],
                    'nama_level' => $row[1],
                ]);
            }

            // Insert Data User
            foreach ($dataUser as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('UserModel')->insert([
                    'id_user' => $row[0],
                    'nama' => $row[1],
                    'username' => $row[2],
                    'email' => $row[3],
                    'password' => $row[4],
                    'id_level' => $row[5],
                ]);
            }

            // Insert Data Peminjaman
            foreach ($dataPeminjaman as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('PeminjamanModel')->insert([
                    'id_peminjaman' => $row[0],
                    'tgl_pinjam' => $row[1],
                    'tgl_kembali' => $row[2],
                    'status_peminjaman' => $row[3],
                    'id_user' => $row[4],
                ]);
            }

            // Insert Data Detail Peminjaman
            foreach ($dataDetailPeminjaman as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                model('DetailPeminjamanModel')->insert([
                    'id_detail_peminjaman' => $row[0],
                    'id_inventaris' => $row[1],
                    'id_peminjaman' => $row[2],
                    'jumlah' => $row[3],
                ]);
            }

            return redirect()->back()->with('success', 'Database berhasil di restore dari Excel!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database gagal di restore dari Excel! ' . $e->getMessage());
        }

    }

    public function download($filename)
    {
        return $this->response->download('database/' . $filename, null);
    }

    public function delete($filename)
    {
        $path = 'database/' . $filename;

        if (file_exists($path)) {
            unlink($path);
            return redirect()->back()->with('success', 'File berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }
    }

    public function deleteAll()
    {
        $folderPath = 'database/';
        $files = $this->getAllFilesFromFolder($folderPath);

        foreach ($files as $file) {
            $path = $folderPath . $file;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        return redirect()->back()->with('success', 'Semua file berhasil dihapus!');
    }

    private function getFileTimestamp($filePath)
    {
        if (!file_exists($filePath)) {
            return 'File does not exist.';
        }

        $timestamp = filemtime($filePath);

        return date("F d Y H:i:s.", $timestamp);
    }

    private function getLatestFileFromFolder($folderPath)
    {
        if (!is_dir($folderPath)) {
            return 'Directory does not exist.';
        }

        $files = scandir($folderPath, SCANDIR_SORT_DESCENDING);
        $newest_file = $files[0];

        return $newest_file;
    }

    private function getAllFilesFromFolder($folderPath)
    {
        if (!is_dir($folderPath)) {
            return 'Directory does not exist.';
        }

        $files = scandir($folderPath);

        // Remove '.' and '..' from the array
        unset($files[array_search('.', $files, true)]);
        unset($files[array_search('..', $files, true)]);

        // Re-index the array
        $files = array_values($files);

        // Descending order
        rsort($files);

        return $files;
    }

    private function getFileExtension($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

}
