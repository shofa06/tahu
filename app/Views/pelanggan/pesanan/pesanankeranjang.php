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
        <!-- Dummy Card 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-left-warning">
                <div class="card-body">
                    <h5 class="card-title">INV-00123</h5>
                    <p class="mb-1"><strong>Produk:</strong> Tahu Bakso Crispy (Isi 10)</p>
                    <p class="mb-1"><strong>Jumlah:</strong> 2</p>
                    <p class="mb-1"><strong>Tanggal:</strong> 2025-05-18</p>
                    <span class="badge bg-warning text-dark">Diproses</span>
                </div>
            </div>
        </div>

        <!-- Dummy Card 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-left-info">
                <div class="card-body">
                    <h5 class="card-title">INV-00124</h5>
                    <p class="mb-1"><strong>Produk:</strong> Kripik Tempe Pedas</p>
                    <p class="mb-1"><strong>Jumlah:</strong> 1</p>
                    <p class="mb-1"><strong>Tanggal:</strong> 2025-05-17</p>
                    <span class="badge bg-info text-white">Dikirim</span>
                </div>
            </div>
        </div>

        <!-- Dummy Card 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-left-success">
                <div class="card-body">
                    <h5 class="card-title">INV-00125</h5>
                    <p class="mb-1"><strong>Produk:</strong> Tahu Bakso Original (Isi 20)</p>
                    <p class="mb-1"><strong>Jumlah:</strong> 1</p>
                    <p class="mb-1"><strong>Tanggal:</strong> 2025-05-15</p>
                    <span class="badge bg-success">Selesai</span>
                </div>
            </div>
        </div>

        <!-- Dummy Card 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-left-danger">
                <div class="card-body">
                    <h5 class="card-title">INV-00126</h5>
                    <p class="mb-1"><strong>Produk:</strong> Tahu Bakso Spesial Keju</p>
                    <p class="mb-1"><strong>Jumlah:</strong> 3</p>
                    <p class="mb-1"><strong>Tanggal:</strong> 2025-05-14</p>
                    <span class="badge bg-danger">Dibatalkan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
