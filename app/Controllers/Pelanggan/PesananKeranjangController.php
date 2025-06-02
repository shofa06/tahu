<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel;

class PesananKeranjangController extends BaseController
{
    public $pesanan;
    public function __construct()
    {
        $this->pesanan = new PesananModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user') ?? 1;

        // Ambil semua pesanan milik user
        $pesananList = $this->pesanan
            ->where('id_user', $id_user)
            ->orderBy('tanggal_pemesanan', 'DESC')
            ->findAll();

        $pesananDetailModel = new \App\Models\PesananDetailModel();

        // Untuk setiap pesanan, ambil detailnya
        foreach ($pesananList as &$pesanan) {
            $pesanan['detail'] = $pesananDetailModel
                ->select('pesanan_detail.*, produk.nama_produk, kategori.nama_kategori')
                ->join('produk', 'produk.id_produk = pesanan_detail.id_produk')
                ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
                ->where('id_pesanan', $pesanan['id_pesanan'])
                ->findAll();
        }

        $data = [
            'dataPesanan' => $pesananList,
        ];

        return view('pelanggan/pesanan/pesanankeranjang', $data);
    }
}
