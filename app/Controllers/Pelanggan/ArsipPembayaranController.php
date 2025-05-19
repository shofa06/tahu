<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ArsipPembayaranController extends BaseController
{
    public function index()
    {
        return view('pelanggan/arsip/arsippembayaran');
    }
}
