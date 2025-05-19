<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class PenggunaController extends BaseController
{   
    public $pengguna;
    public function __construct()
    {
        $this->pengguna = new UserModel();
    }

    public function index()
    {
        $data = [
            'dataPengguna' => $this->pengguna->findAll(),
        ];
        return view('admin/pengguna/pengguna', $data);
    }

    public function tambah()
    {
        return view('admin/pengguna/tambah');
    }

    public function edit($id)
    {
        // Mengambil data pengguna berdasarkan ID
        $data = [
            'dataPengguna' => $this->pengguna->where('id_user', $id)->first(),
        ];
        return view('admin/pengguna/edit', $data);
    }
    
    public function simpan()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor telepon wajib diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                    'min_length' => 'Username minimal 3 karakter.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 6 karakter.'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role wajib dipilih.'
                ]
            ],
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        // Menyimpan data pengguna baru yang diambil dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
        ];

        if ($this->pengguna->insert($data)) {
            return redirect()->to('/admin/pengguna')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                    'min_length' => 'Username minimal 3 karakter.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor telepon wajib diisi.',
                    'numeric' => 'Nomor telepon harus berupa angka.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ]
            ],

            
            // Add other validation rules as needed
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        
        // Mengambil data pengguna berdasarkan ID
        $data = [
            'username' => $this->request->getPost('username'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'gambar' => $this->request->getFile('gambar'),
            // Add other fields as needed
        ];

        if ($this->pengguna->update($id, $data)) {
            return redirect()->to('/admin/pengguna')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }
   
    public function hapus($id){

        $pengguna = $this->pengguna->find($id);
        if ($this->pengguna->delete($id)) {
            return redirect()->to('/admin/pengguna')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
