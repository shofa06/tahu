<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananDetailModel extends Model
{
    protected $table = 'pesanan_detail';
    protected $primaryKey = 'id_pesanan_detail';

    protected $allowedFields = [
        'id_pesanan',
        'id_produk',
        'nama_produk',
        'harga_satuan',
        'jumlah',
        'total_harga'
    ];

    protected $useTimestamps = false;

    public function getDetailByPesananId($id_pesanan)
    {
        return $this->where('id_pesanan', $id_pesanan)->findAll();
    }
}
