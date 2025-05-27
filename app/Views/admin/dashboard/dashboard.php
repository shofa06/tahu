<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card-group">
        <!-- Total Produk -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <i class="mdi mdi-cube-outline font-20 text-muted"></i> <!-- produk -->
                                <p class="font-16 m-b-5">Total Produk</p>
                            </div>
                            <div class="ml-auto">
                                <h1 class="font-light text-right"><?= $total_produk ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <i class="mdi mdi-cart-outline font-20 text-muted"></i> <!-- pesanan -->
                                <p class="font-16 m-b-5">Total Pesanan</p>
                            </div>
                            <div class="ml-auto">
                                <h1 class="font-light text-right"><?= $total_pesanan ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 60%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pesanan Belum Bayar -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <i class="mdi mdi-credit-card-off-outline font-20 text-muted"></i> <!-- belum bayar -->
                                <p class="font-16 m-b-5">Total Pesanan Belum Bayar</p>
                            </div>
                            <div class="ml-auto">
                                <h1 class="font-light text-right"><?= $total_belum_bayar ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 65%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pesanan Selesai -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <i class="mdi mdi-check-circle-outline font-20 text-muted"></i> <!-- selesai -->
                                <p class="font-16 m-b-5">Total Pesanan Selesai</p>
                            </div>
                            <div class="ml-auto">
                                <h1 class="font-light text-right"><?= $total_selesai ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 70%; height: 6px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
