<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table            = 'levels';
    protected $primaryKey       = 'id_level';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_level'];

    protected bool $allowEmptyInserts = false;
}
