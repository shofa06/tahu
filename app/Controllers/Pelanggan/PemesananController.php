<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PesananModel;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\LokasiModel;

class PemesananController extends BaseController
{
    public $produk;
    public $kategori;
    public $pesanan;
    public $lokasi;
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->kategori = new KategoriModel();
        $this->pesanan = new PesananModel();
        $this->lokasi = new LokasiModel();

        // Konfigurasi Midtrans
        Config::$serverKey = 'SB-Mid-server-walQvdFyoCRIXr0M-IFMEUAg';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
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
            'dataLokasi' => $this->lokasi->findAll(),
        ];

        return view('pelanggan/pemesanan/pesan', $data);
    }

    public function simpan()
{
    $produkList = $this->request->getPost('produk');
    $id_user = session()->get('id_user') ?? 1;
    $tanggal = date('Y-m-d');
    $kode_pesanan = strtoupper(uniqid('TRX'));

    $pesananModel = new PesananModel();
    $produkModel = new \App\Models\ProdukModel();
    $lokasiModel = new \App\Models\LokasiModel();

    $totalKeseluruhan = 0;

    $alamat = $this->request->getPost('alamat');

    // Ambil id lokasi dari input form
    $id_lokasi = $this->request->getPost('lokasi_pengiriman');
    $ongkir = 0;

    if ($id_lokasi) {
        $lokasi = $lokasiModel->find($id_lokasi);
        if ($lokasi && isset($lokasi['ongkir'])) {
            $ongkir = (int)$lokasi['ongkir'];
        }
    }

    foreach ($produkList as $item) {
        $id_produk = (int)$item['id'];
        $jumlah = (int)$item['jumlah'];

        $produk = $produkModel->find($id_produk);

        $total_harga = (int)str_replace('.', '', $produk['harga']) * $jumlah;
        $totalKeseluruhan += $total_harga;

        dd($total_harga, $ongkir, $totalKeseluruhan);   

        $pesananModel->save([
            'id_user'           => $id_user,
            'id_produk'         => $id_produk,
            'total_harga'       => $total_harga + $ongkir,
            'jumlah'            => $jumlah,
            'tanggal_pemesanan' => $tanggal,
            'kode_pesanan'      => $kode_pesanan,
            'pembayaran'        => 'belum_bayar',
            'alamat'            => $alamat,
        ]);
    }

    // Tambahkan ongkir hanya sekali ke total keseluruhan (bukan per item)
    $totalKeseluruhan += $ongkir;

    // Siapkan Snap token
    $params = [
        'transaction_details' => [
            'order_id' => $kode_pesanan,
            'gross_amount' => $totalKeseluruhan,
        ],
        'customer_details' => [
            'first_name' => 'Pelanggan',
            'email' => 'pelanggan@example.com',
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('pelanggan/pemesanan/bayar', [
        'snapToken' => $snapToken,
        'kode_pesanan' => $kode_pesanan
    ]);
}

}
