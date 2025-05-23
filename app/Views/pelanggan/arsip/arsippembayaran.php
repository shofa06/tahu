<?= $this->extend('layout/template-pelanggan') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-6 align-self-center">
                <h4 class="page-title">Arsip Pesanan</h4>
            </div>
            <div class="col-6 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Arsip</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Daftar Arsip Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>No. Invoice</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dummy data -->
                                <tr>
                                    <td>1</td>
                                    <td>INV-00111</td>
                                    <td>Tahu Bakso Crispy (Isi 10)</td>
                                    <td>2</td>
                                    <td>2025-05-01</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>INV-00112</td>
                                    <td>Samosa</td>
                                    <td>1</td>
                                    <td>2025-04-28</td>
                                    <td><span class="badge bg-danger">Dibatalkan</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>INV-00113</td>
                                    <td>Tahu Bakso Pedas</td>
                                    <td>3</td>
                                    <td>2025-04-25</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
