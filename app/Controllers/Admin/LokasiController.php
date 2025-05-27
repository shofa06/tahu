<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    protected $lokasi;

    public function __construct()
    {
        $this->lokasi = new LokasiModel();
    }

    public function index()
    {
        $data = [
            'dataLokasi' => $this->lokasi->findAll(),
        ];
        return view('admin/lokasi/lokasi', $data);
    }

    public function tambah()
    {
        return view('admin/lokasi/tambah');
    }

    public function edit($id)
    {
        $data = [
            'dataLokasi' => $this->lokasi->where('id_lokasi', $id)->first(),
        ];

        if (!$data['dataLokasi']) {
            return redirect()->to('/admin/lokasi')->with('error', 'Data lokasi tidak ditemukan.');
        }

        return view('admin/lokasi/edit', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'nama_lokasi'   => 'required',
            'jarak_tempuh'  => 'required|max_length[20]', // BUKAN numeric lagi
            'ongkir'        => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $this->lokasi->save([
            'nama_lokasi'   => $this->request->getPost('nama_lokasi'),
            'jarak_tempuh'  => $this->request->getPost('jarak_tempuh'),
            'ongkir'        => $this->request->getPost('ongkir'),
        ]);

        return redirect()->to('/admin/lokasi')->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'nama_lokasi'   => 'required',
            'jarak_tempuh'  => 'required|max_length[20]', // BUKAN numeric lagi
            'ongkir'        => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $this->lokasi->update($id, [
            'nama_lokasi'   => $this->request->getPost('nama_lokasi'),
            'jarak_tempuh'  => $this->request->getPost('jarak_tempuh'),
            'ongkir'        => $this->request->getPost('ongkir'),
        ]);

        return redirect()->to('/admin/lokasi')->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $lokasi = $this->lokasi->find($id);

        if ($this->lokasi->delete($id)) {
            return redirect()->to('/admin/lokasi')->with('success', 'Data lokasi berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data lokasi gagal dihapus');
        }
    }
}
