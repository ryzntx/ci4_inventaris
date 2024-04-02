<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table            = 'inventaris';
    protected $primaryKey       = 'id_inventaris';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_inventaris', 'nama', 'merek', 'spesifikasi', 'kondisi', 'jumlah', 'harga', 'sumber', 'foto', 'id_ruangan', 'id_user'];

    protected bool $allowEmptyInserts = false;

    public function getInventaris()
    {
        return $this->db->table('inventaris')
            ->select('inventaris.*, ruangans.nama_ruangan, users.nama as nama_user')
            ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
            ->join('users', 'users.id_user = inventaris.id_user')
            ->get()->getResult();
    }

    public function getInventarisById($id_inventaris)
    {
        return $this->db->table('inventaris')
            ->select('inventaris.*, ruangans.nama_ruangan, users.nama as nama_user')
            ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
            ->join('users', 'users.id_user = inventaris.id_user')
            ->where('id_inventaris', $id_inventaris)
            ->get()->getRow();
    }

    public function getInventarisByRuangan($id_ruangan)
    {
        return $this->db->table('inventaris')
            ->select('inventaris.*, ruangans.nama_ruangan, users.nama as nama_user')
            ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
            ->join('users', 'users.id_user = inventaris.id_user')
            ->where('inventaris.id_ruangan', $id_ruangan)
            ->get()->getResult();
    }
}
