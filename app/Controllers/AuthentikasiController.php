<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthentikasiController extends BaseController
{
    public function login()
    {
        //
        return view('auth/login');
    }
    public function proses()
    {
        $session = session();
        $model = new \App\Models\UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $model->where('username', $username)->first();

        // cek apakah username ada
        if ($data) {
            $pass = $data['password'];
            if (password_verify($password, $pass)) {
                $session->set([
                    'id_user' => $data['id_user'],
                    'username' => $data['username'],
                    'logged_in' => true,
                ]);
                if($data['level'] == 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($data['level'] == 'karyawan') {
                    return redirect()->to('/karyawan/dashboard');
                } elseif ($data['level'] == 'pelanggan') {
                    return redirect()->to('/pelanggan/dashboard');
                }
                else {
                    return redirect()->to('login')->with('error', 'Level tidak dikenali.');
                }
            } else {
                return redirect()->to('login')->with('error', 'Password salah.');
            }
        } else {
            // Jika username tidak ditemukan
            return redirect()->to('login')->with('error', 'Username tidak ditemukan.');
        }
        return view('auth/login');
    }

    public function registrasi()
    {
        return view('auth/registrasi');
    }

    public function simpanRegistrasi()
    {
        $model = new \App\Models\UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'level' => 'pelanggan',
        ];
        $model->insert($data);
        return redirect()->to('login')->with('success', 'Registrasi berhasil, silahkan login.');
    }
}
