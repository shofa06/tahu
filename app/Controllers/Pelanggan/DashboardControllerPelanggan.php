<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardControllerPelanggan extends BaseController
{
    public function index()
    {

        return view('pelanggan/dashboard/dashboard');
    }
}
