<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Beranda extends BaseController
{
    public function index()
    {
        return view('pages/beranda');
    }
}
