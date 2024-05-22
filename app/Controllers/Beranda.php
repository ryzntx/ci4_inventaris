<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Beranda extends BaseController
{
    public function index()
    {
        $data = [
            'barang' => model('InventarisModel')->countAll(),
            'ruangan' => model('RuanganModel')->countAll(),
            'pengguna' => model('UserModel')->countAll(),
            'peminjaman' => model('PeminjamanModel')->countAll(),
        ];

        if (session()->get('level') == '3') {
            $data['peminjaman'] = count(model('PeminjamanModel')->where('id_user', session()->get('id_user'))->find());
        }

        return view('pages/beranda', $data);
    }
}
