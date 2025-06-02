<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Midtrans\Transaction;
use App\Models\PesananModel;


class MidtransController extends BaseController
{
     public function notification()
{
    $json = file_get_contents("php://input");
    file_put_contents(WRITEPATH . 'logs/midtrans_notification.txt', $json);

    $data = json_decode($json, true);
    $order_id = $data['order_id'] ?? null;
    $transaction_status = $data['transaction_status'] ?? null;

    $pesananModel = new PesananModel();
    $pesanan = $pesananModel->where('kode_pesanan', $order_id)->first();

    if (!$pesanan) {
        file_put_contents(WRITEPATH . 'logs/midtrans_error.txt', "Pesanan tidak ditemukan: $order_id\n", FILE_APPEND);
        return $this->response->setStatusCode(404)->setBody('Pesanan tidak ditemukan');
    }

    if ($transaction_status === 'settlement') {
        $pesananModel->update($pesanan['id_pesanan'], ['pembayaran' => 'sudah_bayar']);
        file_put_contents(WRITEPATH . 'logs/midtrans_success.txt', "Status updated untuk order $order_id\n", FILE_APPEND);
    } else {
        file_put_contents(WRITEPATH . 'logs/midtrans_info.txt', "Status $transaction_status untuk order $order_id\n", FILE_APPEND);
    }

    return $this->response->setStatusCode(200)->setBody('OK');
}

}
