<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class MidtransCallback extends ResourceController
{
    public function index()
    {
        // Ambil JSON dari Midtrans
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, true);

        // Log untuk cek jika perlu (hanya aktifkan di debug)
        log_message('info', 'MIDTRANS CALLBACK: ' . print_r($result, true));

        // Ambil data penting
        $order_id           = $result['order_id'] ?? null;
        $transaction_status = $result['transaction_status'] ?? null;
        $payment_type       = $result['payment_type'] ?? null;
        $gross_amount       = $result['gross_amount'] ?? null;

        if (!$order_id) {
            return $this->fail('Order ID tidak ditemukan', 400);
        }

        // Update ke database
        $db = \Config\Database::connect();
        $builder = $db->table('transaksi');

        $builder->where('order_id', $order_id)
                ->update([
                    'status' => $transaction_status,
                    'payment_type' => $payment_type,
                    'gross_amount' => $gross_amount,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

        return $this->respond(['message' => 'Callback diterima dan diproses.']);
    }
}
