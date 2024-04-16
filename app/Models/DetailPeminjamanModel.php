<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPeminjamanModel extends Model
{
    protected $table            = 'detail_peminjamans';
    protected $primaryKey       = 'id_detail_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_inventaris', 'id_peminjaman', 'jumlah'];

    public function ambilDataDetailPeminjaman()
    {
        return $this->db->table('detail_peminjamans')
            ->join('inventaris', 'inventaris.id_inventaris = detail_peminjamans.id_inventaris')
            ->get()->getResult();
    }

    public function hapusDetailPeminjaman($id_peminjaman)
    {
        return $this->db->table('detail_peminjamans')
            ->where('id_peminjaman', $id_peminjaman)
            ->delete();
    }
}