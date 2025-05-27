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
        $id_user = session()->get('id_user') ?? 1; // Menggunakan ID user dari session atau default ke 1
       
        $data = [
            'dataPesanan' => $this->pesanan->join('produk', 'produk.id_produk = pesanan.id_produk')->join('kategori', 'kategori.id_kategori = produk.id_kategori')->where('id_user',$id_user)->findAll(),
        ];
        return view('pelanggan/pesanan/pesanankeranjang',$data);

    }
}
