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
        $data = [
            'dataPesanan' => $this->pesanan->join('produk', 'produk.id_produk = pesanan.id_produk')->join('kategori', 'kategori.id_kategori = produk.id_kategori')->findAll(),
        ];

        return view('admin/pesanan/pesanan', $data);
    }
}
