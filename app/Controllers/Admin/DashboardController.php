<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PesananModel;

class DashboardController extends BaseController
{
    protected $produkModel;
    protected $pesananModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        // Ambil total data dari database
        $totalProduk = $this->produkModel->countAll();
        $totalPesanan = $this->pesananModel->countAll();
        $totalBelumBayar = $this->pesananModel->where('pembayaran', 'Belum Bayar')->countAllResults();
        $totalSelesai = $this->pesananModel->where('pembayaran', 'Selesai')->countAllResults();

        $data = [
            'total_produk'      => $totalProduk,
            'total_pesanan'     => $totalPesanan,
            'total_belum_bayar' => $totalBelumBayar,
            'total_selesai'     => $totalSelesai,
        ];

        return view('admin/dashboard/dashboard', $data);
    }
}
