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
        <!-- Dummy Card 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-left-warning">
                <div class="card-body">
                    <h5 class="card-title">INV-00123</h5>
                    <p class="mb-1"><strong>Produk:</strong> <?= $pesanan['nama_produk'] ?></p>
                    <p class="mb-1"><strong>Jumlah:</strong> <?= $pesanan['jumlah'] ?></p>
                    <p class="mb-1"><strong>Tanggal:</strong> <?= $pesanan['tanggal_pemesanan'] ?></p>
                    <span class="badge bg-warning text-dark"><?= $pesanan['status'] ?></span>
                </div>
            </div>
        </div>

        <?php endforeach; ?>        

       
    </div>
</div>
<?= $this->endSection() ?>
