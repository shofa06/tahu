<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .payment-container h3 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .pay-btn {
            padding: 0.75rem 1.5rem;
            background-color: #009fe3;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .pay-btn:hover {
            background-color: #007bb6;
        }

        .info-text {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h3>Pembayaran Pesanan #<?= esc($kode_pesanan) ?></h3>
        <button id="pay-button" class="pay-btn">Bayar Sekarang</button>
        <div class="info-text">Transaksi Anda aman dan terenkripsi oleh Midtrans</div>
    </div>

    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('<?= $snapToken ?>', {
                onSuccess: function(result){
                    alert('✅ Pembayaran berhasil!');
                    window.location.href = '/';
                },
                onPending: function(result){
                    alert('⌛ Menunggu pembayaran...');
                },
                onError: function(result){
                    alert('❌ Terjadi kesalahan saat pembayaran.');
                },
                onClose: function(){
                    alert('⛔ Anda menutup popup pembayaran.');
                }
            });
        };
    </script>
</body>
</html>
