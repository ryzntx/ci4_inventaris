<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
        $this->userModel->save([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_level' => $this->request->getPost('id_level'),
            'foto' => $fotoName ?? 'default.jpg',
        ]);

        return redirect()->to(base_url('manajemen-akun'));
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
        $this->userModel->save($data);

        return redirect()->to(base_url('manajemen-akun'));
    }

    public function hapus($id)
    {
        $user = $this->userModel->find($id);
        if ($user->foto != null && $user->foto != 'default.jpg' && file_exists('uploads/foto/' . $user->foto)) {
            unlink('uploads/foto/' . $user->foto);
        }
        $this->userModel->delete($id);

        return redirect()->to(base_url('manajemen-akun'));
    }
}