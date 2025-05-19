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
                'rules' => 'is_image[gambar]|max_size[gambar,2048]',
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
            ],
            // Add other validation rules as needed
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Cek apakah gambar diupload
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid()) {
            // Pindahkan gambar ke folder yang diinginkan
            $gambar->move('uploads/produk', $gambar->getName());
            $data['gambar'] = $gambar->getName();
        } else {
            // Jika tidak ada gambar baru, ambil nama gambar lama
            $data['gambar'] = $this->produk->find($id)['gambar'];
        }

        // Menyimpan data produk baru yang diambil dari form
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'gambar' => $gambar->getName(),
            'stok' => $this->request->getPost('stok'),
            // Add other fields as needed
        ];

        if ($this->produk->update($id, $data)) {
            return redirect()->to('/admin/produk')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }
    public function simpan()
    {
        // Validasi input
        

        

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
            // Add other validation rules as needed
        ]);
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        // Cek apakah gambar diupload
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid()) {
            // Pindahkan gambar ke folder yang diinginkan
            $gambar->move('uploads/produk', $gambar->getName());
            $data['gambar'] = $gambar->getName();
        } else {
            return redirect()->back()->with('error', 'Gambar tidak valid');
        }

        // Menyimpan data produk baru yang diambil dari form
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'gambar' => $gambar->getName(),
            'stok' => $this->request->getPost('stok'),
            // Add other fields as needed
        ];

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
