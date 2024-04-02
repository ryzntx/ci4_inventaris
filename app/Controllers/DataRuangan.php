<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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
            'ruangans' => $this->ruanganModel->findAll()
        ];

        return view('pages/admin/ruangan/index', $data);
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
            'foto' => $fotoName
        ]);

        return redirect()->to(base_url('data-ruangan'));
    }

    public function editAction($id_ruangan)
    {
        $foto = $this->request->getFile('foto_ruangan');
        $data = [
            'id_ruangan' => $id_ruangan,
            'nama_ruangan' => $this->request->getPost('nama_ruangan')
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
        $this->ruanganModel->delete($id_ruangan);

        return redirect()->to(base_url('data-ruangan'));
    }
}
