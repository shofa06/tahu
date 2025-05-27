<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\PesananModel;
use Midtrans\Config;
use App\Models\LokasiModel;
use Midtrans\Snap;

class PesanProdukController extends BaseController
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
            'dataLokasi' => $this->lokasi->findAll(),
        ];
        return view('pelanggan/pesanproduk/pesanproduk', $data);
    }

   public function order()
{
    $produkList = $this->request->getPost('produk');
    $id_user = session()->get('id_user') ?? 1;
    $tanggal = date('Y-m-d');
    $kode_pesanan = strtoupper(uniqid('TRX'));

    $pesananModel = new \App\Models\PesananModel();
    $produkModel = new \App\Models\ProdukModel();
    $lokasiModel = new \App\Models\LokasiModel();

    if (!$produkList || !is_array($produkList)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
    }

    $totalKeseluruhan = 0;
    $alamat = $this->request->getPost('alamat');
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

        // Hapus titik pada harga dan konversi ke int
        $harga = (int) str_replace('.', '', $produk['harga']);
        $total_harga = $harga * $jumlah;
        $totalKeseluruhan += $total_harga;

        // Simpan data pesanan
        $pesananModel->save([
            'id_user'           => $id_user,
            'id_produk'         => $id_produk,
            'total_harga'       => $total_harga,
            'jumlah'            => $jumlah,
            'tanggal_pemesanan' => $tanggal,
            'kode_pesanan'      => $kode_pesanan,
            'pembayaran'        => 'belum_bayar',
            'alamat'            => $alamat,
        ]);

        // Kurangi stok produk, pastikan stok tidak negatif
        $stokSekarang = (int)$produk['stok'];
        $stokBaru = max(0, $stokSekarang - $jumlah);

        $produkModel->update($id_produk, ['stok' => $stokBaru]);
    }

    $totalKeseluruhan += $ongkir;

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

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    session()->setFlashdata([
        'snapToken' => $snapToken,
        'kode_pesanan' => $kode_pesanan,
    ]);

    return redirect()->to('pelanggan/pesan-produk');
}

}
