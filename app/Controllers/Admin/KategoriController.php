<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public $kategori;
    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }


    public function index()
    {
        $data = [
            'dataKategori' => $this->kategori->findAll(),
        ];

        return view('admin/kategori/kategori', $data);
    }

    public function tambah()
    {
        return view('admin/kategori/tambah');
    }

    public function edit($id)
    {
        $data = [
            'dataKategori' => $this->kategori->where('id_kategori', $id)->first(),
        ];
        return view('admin/kategori/edit', $data);
    }
    public function update($id)
    {
        $id = (int)$id; // Pastikan ID dikonversi ke integer
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => [
                'rules' => 'required|min_length[3]|is_unique[kategori.nama_kategori,id_kategori,{id}]',
                'errors' => [
                    'required' => 'Nama kategori wajib diisi.',
                    'min_length' => 'Nama kategori minimal 3 karakter.',
                    'is_unique' => 'Nama kategori sudah ada, tidak boleh duplikat.'
                ]
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        // Menyimpan data pengguna baru yang diambil dari form
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        if ($this->kategori->update($id, $data)) {
            return redirect()->to('/admin/kategori')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }
    public function simpan()
    {
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kategori' => [
                'rules' => 'required|min_length[3]|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'required' => 'Nama kategori wajib diisi.',
                    'min_length' => 'Nama kategori minimal 3 karakter.',
                    'is_unique' => 'Nama kategori sudah ada, tidak boleh duplikat.'
                ]
            ],
        ]);


        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        // Menyimpan data pengguna baru yang diambil dari form
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        if ($this->kategori->insert($data)) {
            return redirect()->to('/admin/kategori')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function hapus($id)
    {

        $kategori = $this->kategori->find($id);
        if ($this->kategori->delete($id)) {
            return redirect()->to('/admin/kategori')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
