<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel;
use App\Models\ProdukModel;

class PesananControllerKaryawan extends BaseController
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

        return view('karyawan/pesanan/pesanan', $data);
    }

    public function ubahStatus($id_produk)
    {
        // Ambil nilai status dari POST
        $statusBaru = $this->request->getPost('status');

        // Validasi data (opsional, bisa ditambah sesuai kebutuhan)
        if (!$statusBaru) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        // Lakukan update status di tabel pesanan
        $this->pesanan->where('id_pesanan', $id_produk)->set(['status' => $statusBaru])->update();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Status berhasil diubah menjadi: ' . $statusBaru);
    }
}
