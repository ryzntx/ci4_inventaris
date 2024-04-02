<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'username', 'email', 'password', 'foto', 'status', 'id_level',];

    protected bool $allowEmptyInserts = false;

    public function ambilDataLogin()
    {
        return $this->where('id_user', session()->get('id_user'))->first();
    }

    public function getUsers()
    {
        return $this->joinLevel();
    }

    public function joinLevel()
    {
        return $this->join('levels', 'levels.id_level = users.id_level')->findAll();
    }

    public function joinLevelWhere($id)
    {
        return $this->join('levels', 'levels.id_level = users.id_level')->where('id_user', $id)->first();
    }
}
