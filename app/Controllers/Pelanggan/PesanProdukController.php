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
    $pesananDetailModel = new \App\Models\PesananDetailModel();
    $produkModel = new \App\Models\ProdukModel();
    $lokasiModel = new \App\Models\LokasiModel();

    if (!$produkList || !is_array($produkList)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
    }

    $alamat = $this->request->getPost('alamat');
    $id_lokasi = $this->request->getPost('lokasi_pengiriman');
    $ongkir = 0;

    if ($id_lokasi) {
        $lokasi = $lokasiModel->find($id_lokasi);
        if ($lokasi && isset($lokasi['ongkir'])) {
            $ongkir = (int)$lokasi['ongkir'];
        }
    }

    // 1. Simpan dulu data ke tabel pesanan (tanpa total)
    $pesananModel->insert([
        'id_user'           => $id_user,
        'kode_pesanan'      => $kode_pesanan,
        'tanggal_pemesanan' => $tanggal,
        'pembayaran'        => 'belum_bayar',
        'alamat'            => $alamat,
        'id_lokasi'         => $id_lokasi,
        'ongkir'            => $ongkir,
        'total_harga'       => 0 // sementara
    ]);

    $id_pesanan = $pesananModel->getInsertID();
    $totalKeseluruhan = 0;

    // 2. Proses setiap produk
    foreach ($produkList as $item) {
        $id_produk = (int)$item['id'];
        $jumlah = (int)$item['jumlah'];

        $produk = $produkModel->find($id_produk);
        if (!$produk) continue;

        $harga = (int) str_replace('.', '', $produk['harga']);
        $total_harga = $harga * $jumlah;
        $totalKeseluruhan += $total_harga;

        // Simpan ke pesanan_detail
        $pesananDetailModel->insert([
            'id_pesanan'   => $id_pesanan,
            'id_produk'    => $id_produk,
            'nama_produk'  => $produk['nama_produk'], // jika kamu simpan nama
            'harga_satuan' => $harga,
            'jumlah'       => $jumlah,
            'total_harga'  => $total_harga
        ]);

        // Update stok produk
        $stokSekarang = (int)$produk['stok'];
        $stokBaru = max(0, $stokSekarang - $jumlah);
        $produkModel->update($id_produk, ['stok' => $stokBaru]);
    }

    // 3. Update total harga pesanan
    $totalKeseluruhan += $ongkir;
    $pesananModel->update($id_pesanan, ['total_harga' => $totalKeseluruhan]);

    // 4. Midtrans snap token
    $params = [
        'transaction_details' => [
            'order_id'     => $kode_pesanan,
            'gross_amount' => $totalKeseluruhan,
        ],
        'customer_details' => [
            'first_name' => 'Pelanggan',
            'email'      => 'pelanggan@example.com',
        ],
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    session()->setFlashdata([
        'snapToken'     => $snapToken,
        'kode_pesanan'  => $kode_pesanan,
    ]);

    return redirect()->to('pelanggan/pesan-produk');
}


}
