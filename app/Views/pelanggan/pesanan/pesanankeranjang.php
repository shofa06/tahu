<?= $this->extend('layout/template-pelanggan') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Pesanan Saya</h4>
            </div>
            <div class="col-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="row">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php foreach ($dataPesanan as $pesanan) : ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-left-warning mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Kode Pesanan: <?= $pesanan['kode_pesanan'] ?></h5>
                        <p class="mb-1"><strong>Tanggal:</strong> <?= $pesanan['tanggal_pemesanan'] ?></p>
                        <p class="mb-2"><strong>Alamat:</strong> <?= $pesanan['alamat'] ?></p>
                        
                        <strong>Produk Dipesan:</strong>
                        <ul class="mb-2">
                            <?php foreach ($pesanan['detail'] as $detail) : ?>
                                <li><?= $detail['nama_produk'] ?> - <?= $detail['jumlah'] ?> x Rp<?= number_format($detail['harga_satuan']) ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <p><strong>Total Harga: </strong>Rp<?= number_format($pesanan['total_harga']) ?></p>

                        <span class="badge bg-warning text-dark"><?= $pesanan['pembayaran'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>        
    </div>
</div>
<?= $this->endSection() ?>
