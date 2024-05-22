<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
}
