<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['tgl_pinjam', 'tgl_kembali', 'status_peminjaman', 'id_user'];

    public function ambilDataPeminjaman(?int $limit = null, ?array $orderBy = null, ?string $id = null, ?string $id_user = null, ?array $tanggal = null, ?string $status = null, ?string $ruangan = null)
    {
        $builder = $this
            ->select('peminjamans.id_peminjaman, users.nama, peminjamans.status_peminjaman, peminjamans.tgl_pinjam, peminjamans.tgl_kembali')
            ->distinct()
            ->join('detail_peminjamans', 'detail_peminjamans.id_peminjaman = peminjamans.id_peminjaman', 'inner')
            ->join('inventaris', 'inventaris.id_inventaris = detail_peminjamans.id_inventaris')
            ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
            ->join('users', 'users.id_user = peminjamans.id_user');
        if ($id) {
            $builder->where('peminjamans.id_peminjaman', $id);
            // return $builder->get()->getRow();
        }
        if ($id_user) {
            $builder->where('peminjamans.id_user', $id_user);
        }
        if ($tanggal) {
            $builder->where('tgl_pinjam BETWEEN "' . $tanggal[0] . '" AND "' . $tanggal[1] . '"');
        }
        if ($ruangan) {
            $builder->where('inventaris.id_ruangan', $ruangan);
        }
        if ($status) {
            $builder->where('peminjamans.status_peminjaman', $status);
        }
        if ($orderBy) {
            $builder->orderBy($orderBy[0], $orderBy[1]);
        }
        if ($limit) {
            $builder->limit($limit);
        }
        return $builder->get()->getResult();
    }

    public function cetakDataPeminjaman(?string $id = null, ?string $id_user = null, ?array $tanggal = null, ?string $status = null, ?string $ruangan = null)
    {
        $builder = $this->db->table('peminjamans')
            ->select('users.nama, peminjamans.status_peminjaman, peminjamans.tgl_pinjam, peminjamans.tgl_kembali, inventaris.nama AS nama_inventaris, ruangans.nama_ruangan, detail_peminjamans.jumlah')
            ->join('detail_peminjamans', 'detail_peminjamans.id_peminjaman = peminjamans.id_peminjaman', 'inner')
            ->join('inventaris', 'inventaris.id_inventaris = detail_peminjamans.id_inventaris')
            ->join('ruangans', 'ruangans.id_ruangan = inventaris.id_ruangan')
            ->join('users', 'users.id_user = peminjamans.id_user')
            ->orderBy('peminjamans.id_peminjaman', 'ASC');
        if ($id) {
            $builder->where('peminjamans.id_peminjaman', $id);
            return $builder->get()->getRow();
        }
        if ($id_user) {
            $builder->where('peminjamans.id_user', $id_user);
        }
        if ($tanggal) {
            $builder->where('tgl_pinjam >=', $tanggal[0])
                ->where('tgl_kembali <=', $tanggal[1]);
        }
        if ($status) {
            $builder->where('status_peminjaman', $status);
        }
        if ($ruangan) {
            $builder->where('inventaris.id_ruangan', $ruangan);
        }
        return $builder->get()->getResult();
    }

    public function getPeminjaman()
    {
        // get all data peminjaman as array of object, then join with users table to get all data user as field
        return $this->db->table('peminjamans')
            ->select('peminjamans.*, users.nama')
            ->join('users', 'users.id_user = peminjamans.id_user')
            ->get()->getResult();
    }
}