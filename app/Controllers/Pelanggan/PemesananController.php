<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PesananModel;

class PemesananController extends BaseController
{
    public $produk;
    public $kategori;
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'dataProduk' => $this->produk->join('kategori', 'kategori.id_kategori = produk.id_kategori')->findAll(),
            'dataKategori' => $this->kategori->findAll(),
        ];


        return view('pelanggan/pemesanan/pemesanan', $data);
    }

    public function pesan()
    {
        $data = [
            'dataProduk' => $this->produk->join('kategori', 'kategori.id_kategori = produk.id_kategori')->findAll(),
            'dataKategori' => $this->kategori->findAll(),
        ];

        return view('pelanggan/pemesanan/pesan', $data);
    }

    public function simpan()
    {
        $produkList = $this->request->getPost('produk');
        $id_user = session()->get('id_user') ?? 1; // ganti dengan sesi login asli
        $tanggal = date('Y-m-d');
        $kode_pesanan = strtoupper(uniqid('TRX'));
        
        $pesananModel = new PesananModel();
        $produkModel = new \App\Models\ProdukModel();

        foreach ($produkList as $item) {

            $id_produk = (int)$item['id'];
            $jumlah = (int)$item['jumlah'];

            $produk = $produkModel->find($id_produk);
            
            
            $total_harga = (int)str_replace('.', '', $produk['harga']) * $jumlah;
            $pesananModel->save([
                'id_user'           => $id_user,
                'id_produk'         => $id_produk,
                'total_harga'       => $total_harga,
                'jumlah'            => $jumlah,
                'tanggal_pemesanan' => $tanggal,
                'kode_pesanan'      => $kode_pesanan,
                'pembayaran'        => 'belum_bayar'
            ]);
        }

        return redirect()->to('/pesan-produk')->with('success', 'Pesanan berhasil disimpan!');
    }
}
