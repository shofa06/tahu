<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardControllerKaryawan extends BaseController
{
    public function index()
    {
        return view('karyawan/dashboard/dashboard');
    }
}
