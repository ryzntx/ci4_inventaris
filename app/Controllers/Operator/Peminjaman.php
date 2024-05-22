<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class Peminjaman extends BaseController
{
    protected $peminjamanModel, $detailPeminjamanModel, $userModel, $inventarisModel;

    public function __construct()
    {
        $this->peminjamanModel = new \App\Models\PeminjamanModel();
        $this->detailPeminjamanModel = new \App\Models\DetailPeminjamanModel();
        $this->userModel = new \App\Models\UserModel();
        $this->inventarisModel = new \App\Models\InventarisModel();
    }

    public function index()
    {
        $data = [
            'peminjamans' => $this->peminjamanModel->ambilDataPeminjaman(),
        ];
        if (session()->has('keranjang')) {
            $data['keranjang'] = session()->get('keranjang');
        }

        return view('pages/admin-operator/peminjaman/index', $data);
    }

    public function tambah()
    {
        $data = [
            'users' => $this->userModel->findAll(),
            'inventariss' => $this->inventarisModel->getInventaris(),
        ];

        return view('pages/admin-operator/peminjaman/tambah', $data);
    }

    public function tambahItemKeranjang()
    {
        //
        $id_inventaris = $this->request->getVar('id_inventaris');
        $kode_inventaris = $this->request->getVar('kode_inventaris');
        $nama = $this->request->getVar('nama');
        $jumlah = $this->request->getVar('jumlah');
        $row_id = md5($nama . serialize($jumlah));

        $data = [
            $row_id => [
                'id_inventaris' => $id_inventaris,
                'kode_inventaris' => $kode_inventaris,
                'nama' => $nama,
                'jumlah' => $jumlah,
                'row_id' => $row_id,
            ],
        ];

        if (!session()->has('keranjang')) {
            session()->set('keranjang', $data);
        } else {
            $exist = 0;
            $keranjang = session()->get('keranjang');
            //
            foreach ($keranjang as $i => $item) {
                if ($keranjang[$i]['nama'] == $nama) {
                    $keranjang[$i]['jumlah'] += $jumlah;
                    $exist++;
                }
            }
            if ($exist == 0) {
                $keranjang_baru = array_merge_recursive($keranjang, $data);
                session()->set('keranjang', $keranjang_baru);
            } else {
                session()->set('keranjang', $keranjang);
            }
        }
        return redirect()->to('/peminjaman/tambah');
    }

    public function hapusItemKeranjang($row_id)
    {
        $keranjang_baru = session()->get('keranjang');
        foreach ($keranjang_baru as $index => $item) {
            if ($keranjang_baru[$index]['row_id'] == $row_id) {
                unset($keranjang_baru[$index]);
            }
        }
        if (count($keranjang_baru) == 0) {
            session()->remove('keranjang');
            return redirect()->to('/peminjaman/tambah');
        } else {
            session()->set('keranjang', $keranjang_baru);
            return redirect()->to('/peminjaman/tambah');
        }
    }

    public function hapusKeranjang()
    {
        session()->remove('keranjang');
        return redirect()->to('/peminjaman/tambah');
    }

    public function tambahAction()
    {
        //todo: pengurangan item inventaris
        $data = [
            'id_user' => session()->get('id_user'),
            'tgl_pinjam' => $this->request->getVar('tanggal_peminjaman'),
            'tgl_kembali' => $this->request->getVar('tanggal_pengembalian'),
            'status_peminjaman' => 'Dipinjam',
        ];

        $this->peminjamanModel->save($data);
        $id_peminjaman = $this->peminjamanModel->insertID();

        $keranjang = session()->get('keranjang');
        foreach ($keranjang as $item) {
            // Simpan detail peminjaman
            $data_detail = [
                'id_peminjaman' => $id_peminjaman,
                'id_inventaris' => $item['id_inventaris'],
                'jumlah' => $item['jumlah'],
            ];
            $this->detailPeminjamanModel->save($data_detail);
            // Pengurangan item inventaris
            $cari_inventaris = $this->inventarisModel->find($item['id_inventaris']);
            $data_inventaris = [
                'jumlah' => $cari_inventaris->jumlah - $item['jumlah'],
            ];
            $this->inventarisModel->update($item['id_inventaris'], $data_inventaris);

        }

        session()->remove('keranjang');
        return redirect()->to('/peminjaman');
    }

    public function edit($id)
    {
        $data = [
            'peminjaman' => $this->peminjamanModel->find($id),
            'users' => $this->userModel->findAll(),
            'inventariss' => $this->inventarisModel->getInventaris(),
            'detail_peminjaman' => $this->detailPeminjamanModel->getDetailPeminjaman($id),
        ];

        return view('pages/admin-operator/peminjaman/edit', $data);
    }

    public function editAction($id)
    {
        $data = [
            'tgl_pinjam' => $this->request->getVar('tanggal_peminjaman'),
            'tgl_kembali' => $this->request->getVar('tanggal_pengembalian'),
            'status_peminjaman' => $this->request->getVar('status_peminjaman'),
        ];

        // if ($this->request->getVar('status_peminjaman') == 'Dipinjam') {
        //     //todo: pengurangan item inventaris
        //     $detail_peminjaman = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id);
        //     foreach ($detail_peminjaman as $item) {
        //         $cari_inventaris = $this->inventarisModel->find($item->id_inventaris);
        //         $data_inventaris = [
        //             'jumlah' => $cari_inventaris->jumlah - $item->jumlah,
        //         ];
        //         $this->inventarisModel->update($item->id_inventaris, $data_inventaris);

        //     }
        // }
        if ($this->request->getVar('status_peminjaman') == 'Dikembalikan' || $this->request->getVar('status_peminjaman') == 'Pinjaman Ditolak') {
            //todo: penambahan item inventaris
            $detail_peminjaman = $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id);
            foreach ($detail_peminjaman as $item) {
                $cari_inventaris = $this->inventarisModel->find($item->id_inventaris);
                $data_inventaris = [
                    'jumlah' => $cari_inventaris->jumlah + $item->jumlah,
                ];
                $this->inventarisModel->update($item->id_inventaris, $data_inventaris);
            }
        }

        $this->peminjamanModel->update($id, $data);
        return redirect()->to('/peminjaman');
    }

    public function hapus($id)
    {
        //todo: pengembalian item inventaris
        $this->detailPeminjamanModel->hapusDetailPeminjaman($id);
        $this->peminjamanModel->delete($id);
        return redirect()->to('/peminjaman');
    }

    public function lihat($id)
    {
        $data = [
            'peminjaman' => $this->peminjamanModel->find($id),
            'detail_peminjaman' => $this->detailPeminjamanModel->ambilDataDetailPeminjaman($id),
        ];

        return view('pages/admin-operator/peminjaman/lihat', $data);
    }
}
