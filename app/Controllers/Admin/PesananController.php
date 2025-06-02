<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel;
use App\Models\ProdukModel;

class PesananController extends BaseController
{
    public $pesanan;
    public $produk;
    public function __construct()
    {
        $this->pesanan = new PesananModel();
        $this->produk = new ProdukModel();
    }
    public function index()
    {
       $pesananModel = new \App\Models\PesananModel();
    $detailModel = new \App\Models\PesananDetailModel();

    // Ambil parameter dari URL (GET)
    $tanggal = $this->request->getGet('tanggal');
    $bulan   = $this->request->getGet('bulan');
    $tahun   = $this->request->getGet('tahun');

    // Jika semua filter kosong, set default tanggal hari ini
    if (empty($tanggal) && empty($bulan) && empty($tahun)) {
        $tanggal = date('Y-m-d');
    }

    // Query builder dengan urutan terbaru dulu
    $builder = $pesananModel->orderBy('id_pesanan', 'DESC');

    // Filtering berdasarkan input / default
    if (!empty($tanggal)) {
        $builder->where('DATE(tanggal_pemesanan)', $tanggal);
    } else {
        if (!empty($bulan)) {
            $builder->where('MONTH(tanggal_pemesanan)', $bulan);
        }
        if (!empty($tahun)) {
            $builder->where('YEAR(tanggal_pemesanan)', $tahun);
        }
    }

    $dataPesanan = $builder->findAll();

    // Ambil detail produk untuk setiap pesanan
    foreach ($dataPesanan as &$pesanan) {
        $pesanan['detail'] = $detailModel
            ->where('id_pesanan', $pesanan['id_pesanan'])
            ->findAll();
    }

        return view('admin/pesanan/pesanan',  ['dataPesanan' => $dataPesanan]);
}
    }
