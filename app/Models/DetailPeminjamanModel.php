<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPeminjamanModel extends Model
{
    protected $table = 'detail_peminjamans';
    protected $primaryKey = 'id_detail_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_inventaris', 'id_peminjaman', 'jumlah'];

    public function ambilDataDetailPeminjaman(?string $id = null)
    {
        if ($id == null) {
            return $this->db->table('detail_peminjamans')
                ->select('detail_peminjamans.*, inventaris.kode_inventaris, inventaris.nama, ruangans.nama_ruangan')
                ->join('inventaris', 'inventaris.id_inventaris = detail_peminjamans.id_inventaris')
                ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
                ->get()->getResult();

        } else {
            return $this->db->table('detail_peminjamans')
                ->select('detail_peminjamans.*, inventaris.kode_inventaris, inventaris.nama, ruangans.nama_ruangan')
                ->join('inventaris', 'inventaris.id_inventaris = detail_peminjamans.id_inventaris')
                ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
                ->where('detail_peminjamans.id_peminjaman', $id)
                ->get()->getResult();

        }
    }

    public function hapusDetailPeminjaman($id_peminjaman)
    {
        return $this->db->table('detail_peminjamans')
            ->where('id_peminjaman', $id_peminjaman)
            ->delete();
    }
}
