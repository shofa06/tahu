<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SettingModel;
class SettingController extends BaseController
{
    public $setting;
    public function __construct()
    {
        $this->setting = new SettingModel();
    }
    public function setting()
    {
        $data = [
            'dataSetting' => $this->setting->first(),
        ];
        return view('admin/setting/setting', $data);
    }

    public function save($id){
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Email tidak valid.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi.',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No HP wajib diisi.',
                    'numeric' => 'No HP harus berupa angka.'
                ]
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        // Menyimpan data pengguna baru yang diambil dari form
        $data = [
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        if ($this->setting->update($id, $data)) {
            return redirect()->to('/admin/setting')->with('success', "Data berhasil disimpan");
        } else {
            return redirect()->to('/admin/setting')->with('error', "Data gagal disimpan");
        }
    }
}
