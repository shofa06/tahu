<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    public $pengguna;
    public function __construct()
    {
        $this->pengguna = new UserModel();
    }
    public function index()
    {
        $data = [
            'dataPengguna' => $this->pengguna->where('id_user', 6)->first(),
        ];
        return view('admin/profil/profil', $data);
    }
    
    public function update()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'no_telp' => $this->request->getPost('no_telp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
            'gambar' => $this->request->getFile('gambar'),

        ];

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'username wajib diisi.',
                    'min_length' => 'username minimal 3 karakter.'
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
                    'valid_email' => 'Email tidak valid.'
                ]
            ],
        ]);
        if (!$this->validate($validation->getRules())) {
            return redirect()->to('admin/profil')->withInput()->with('validation', $validation);
        }

        // Cek apakah gambar diupload
        if ($this->request->getFile('gambar')->isValid()) {
            $file = $this->request->getFile('gambar');
            $file->move('assets/img/profil');
            $data['gambar'] = $file->getName();
        } else {
            unset($data['gambar']);
        }

        // Cek apakah password diubah
        if ($this->request->getPost('password') != '') {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }


        if ($this->pengguna->update(6, $data)) {
            return redirect()->to('/admin/profil')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Data gagal diupdate');
        }
    }
    public function edit()
    {
        return view('admin/profil/edit');
    }
}
