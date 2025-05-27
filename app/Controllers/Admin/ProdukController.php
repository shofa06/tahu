<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class ProdukController extends BaseController
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
        ];
        return view('admin/produk/produk', $data);
    }


    public function tambah()
    {
        $data = [
            'dataKategori' => $this->kategori->findAll(),
        ];
        return view('admin/produk/tambah', $data);
    }
      

    public function edit($id)
    {   
         $data = [
        'dataProduk' => $this->produk->join('kategori', 'kategori.id_kategori = produk.id_kategori')->where('id_produk', $id)->first(),
        'dataKategori' => $this->kategori->findAll(),];
        return view('admin/produk/edit',$data);
    }

   public function update($id)
{
    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'nama_produk' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Nama produk wajib diisi.',
                'min_length' => 'Nama produk minimal 3 karakter.'
            ]
        ],
        'harga' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Harga wajib diisi.',
                'numeric' => 'Harga harus berupa angka.'
            ]
        ],
        'id_kategori' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori wajib dipilih.'
            ]
        ],
        'gambar' => [
            'rules' => 'if_exist|is_image[gambar]|max_size[gambar,2048]',
            'errors' => [
                'is_image' => 'File yang diupload bukan gambar.',
                'max_size' => 'Ukuran gambar maksimal 2MB.'
            ]
        ],
        'stok' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Stok wajib diisi.',
                'numeric' => 'Stok harus berupa angka.'
            ]
        ]
    ]);

    if (!$this->validate($validation->getRules())) {
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    $produkLama = $this->produk->find($id);
    $gambarBaru = $this->request->getFile('gambar');
    $namaGambar = $produkLama['gambar']; // default pakai gambar lama

    if ($gambarBaru && $gambarBaru->isValid() && !$gambarBaru->hasMoved()) {
        // Hapus gambar lama jika ada
        if (!empty($produkLama['gambar']) && file_exists('uploads/produk/' . $produkLama['gambar'])) {
            unlink('uploads/produk/' . $produkLama['gambar']);
        }

        $namaGambar = $gambarBaru->getRandomName();
        $gambarBaru->move('uploads/produk', $namaGambar);
    }

    $data = [
        'nama_produk' => $this->request->getPost('nama_produk'),
        'harga'       => $this->request->getPost('harga'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'stok'        => $this->request->getPost('stok'),
        'gambar'      => $namaGambar
    ];

    if ($this->produk->update($id, $data)) {
        return redirect()->to('/admin/produk')->with('success', 'Data berhasil diperbarui');
    } else {
        return redirect()->back()->with('error', 'Data gagal diperbarui');
    }
}

    public function simpan()
{
    $validation = \Config\Services::validation();
    $validation->setRules([
        'nama_produk' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required'   => 'Nama produk wajib diisi.',
                'min_length' => 'Nama produk minimal 3 karakter.'
            ]
        ],
        'harga' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Harga wajib diisi.',
                'numeric'  => 'Harga harus berupa angka.'
            ]
        ],
        'stok' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Stok wajib diisi.',
                'numeric'  => 'Stok harus berupa angka.'
            ]
        ],
        'id_kategori' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori wajib dipilih.'
            ]
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]',
            'errors' => [
                'uploaded'  => 'Gambar wajib diunggah.',
                'is_image'  => 'File harus berupa gambar.',
                'mime_in'   => 'Gambar harus bertipe JPG, JPEG, atau PNG.',
                'max_size'  => 'Ukuran gambar maksimal 2MB.'
            ]
        ]
    ]);

    if (!$this->validate($validation->getRules())) {
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    // Ambil file gambar
    $gambar = $this->request->getFile('gambar');
    $namaGambar = $gambar->getRandomName(); // hindari nama ganda

    // Pindahkan gambar ke folder public/uploads/produk
    $gambar->move('uploads/produk', $namaGambar);

    // Siapkan data untuk disimpan
    $data = [
        'nama_produk' => $this->request->getPost('nama_produk'),
        'harga'       => $this->request->getPost('harga'),
        'stok'        => $this->request->getPost('stok'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'gambar'      => $namaGambar
    ];

    // Simpan ke database
    if ($this->produk->insert($data)) {
        return redirect()->to('/admin/produk')->with('success', 'Data berhasil disimpan');
    } else {
        return redirect()->back()->with('error', 'Data gagal disimpan');
    }
}


    public function hapus($id){

        $produk = $this->produk->find($id);
        if ($this->produk->delete($id)) {
            return redirect()->to('/admin/produk')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
