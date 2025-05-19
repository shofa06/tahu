<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PesananKeranjangController extends BaseController
{
    public function index()
    {
        return view('pelanggan/pesanan/pesanankeranjang');
    }
}
