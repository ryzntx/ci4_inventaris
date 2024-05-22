<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjamans';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tgl_pinjam', 'tgl_kembali', 'status_peminjaman', 'id_user'];

    public function ambilDataPeminjaman(?string $id = null,?string $id_user = null)
    {
        if ($id) {
            return $this->db->table('peminjamans')
                ->join('users', 'users.id_user = peminjamans.id_user')
                ->where('peminjamans.id_peminjaman', $id)
                ->get()->getRow();
        }
        if ($id_user) {
            return $this->db->table('peminjamans')
                ->join('users', 'users.id_user = peminjamans.id_user')
                ->where('peminjamans.id_user', $id_user)
                ->get()->getResult();
        }
        return $this->db->table('peminjamans')
            ->join('users', 'users.id_user = peminjamans.id_user')
            ->get()->getResult();
    }
}