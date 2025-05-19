<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Admin Raya No.1',
                'level' => 'admin',
                'gambar' => 'admin.jpg'
            ],
             [
                'username' => 'karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => password_hash('karyawan123', PASSWORD_DEFAULT),
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Admin Raya No.1',
                'level' => 'admin',
                'gambar' => 'admin.jpg'
            ], [
                'username' => 'pelanggan',
                'email' => 'pelanggan@gmail.com',
                'password' => password_hash('pelanggan123', PASSWORD_DEFAULT),
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Admin Raya No.1',
                'level' => 'admin',
                'gambar' => 'admin.jpg'
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
