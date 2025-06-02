<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PesananModel;

class DashboardControllerKaryawan extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $pesananModel = new PesananModel();

        $data = [
            'totalProduk' => $produkModel->countAll(),
            'totalPesanan' => $pesananModel->countAll(),
            'totalBelumBayar' => $pesananModel->where('pembayaran', 'Belum Bayar')->countAllResults(),
            'totalSelesai' => $pesananModel->where('pembayaran', 'Selesai')->countAllResults(),
        ];

        return view('karyawan/dashboard/dashboard', $data);
    }
}
