<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
}