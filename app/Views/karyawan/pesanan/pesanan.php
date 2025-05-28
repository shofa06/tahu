<?= $this->extend('layout/template-karyawan') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Pesanan</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- Table for managing product data -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kelola Data Pesanan</h4>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Kategori</th>
                                    <th>Status Pesanan</th>
                                    <th>Pembayaran</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($dataPesanan as $pesanan) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $pesanan['nama_produk'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($pesanan['tanggal_pemesanan'])) ?></td>
                                        <td>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                                        <td><?= $pesanan['jumlah'] ?></td>
                                        <td><?= $pesanan['nama_kategori'] ?></td>

                                        <!-- Kolom Status Pesanan -->
                                        <td style="color : white;">
                                            <?php
                                            $status = strtolower($pesanan['status']);
                                            $badge = 'warning'; // Default badge color  
                                            if ($status === 'diantar') {
                                                $badge = 'info';
                                            } elseif ($status === 'selesai') {
                                                $badge = 'success';
                                            } elseif ($status === 'batal') {
                                                $badge = 'danger';
                                            }
                                            ?>
                                            <span class="badge bg-<?= $badge ?> text-uppercase">
                                                <?= ucfirst($status) ?>
                                            </span>
                                        </td>
                                        <td><?= $pesanan['pembayaran'] ?></td>
                                        <td><?= $pesanan['alamat'] ?></td>
                                        <!-- Tombol Aksi -->
                                        <td>
                                            <?php
                                            $status = strtolower($pesanan['status']);
                                            $disableDiantar = in_array($status, ['diantar', 'selesai', 'batal']);
                                            $disableSelesaiTolak = in_array($status, ['selesai', 'batal']);
                                            ?>

                                            <!-- Diantar -->
                                            <form action="/karyawan/pesanan/status/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline;">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status" value="diantar">
                                                <button type="submit" class="btn btn-sm btn-info"
                                                    onclick="return confirm('Yakin ingin mengubah status menjadi Diantar?')"
                                                    <?= $disableDiantar ? 'disabled' : '' ?>>
                                                    Diantar
                                                </button>
                                            </form>

                                            <!-- Selesai -->
                                            <form action="/karyawan/pesanan/status/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline; margin-left:5px;">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    onclick="return confirm('Yakin ingin menandai pesanan sebagai Selesai?')"
                                                    <?= $disableSelesaiTolak ? 'disabled' : '' ?>>
                                                    Selesai
                                                </button>
                                            </form>

                                            <!-- Tolak -->
                                            <form action="/karyawan/pesanan/status/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline; margin-left:5px;">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status" value="batal">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menolak pesanan ini?')"
                                                    <?= $disableSelesaiTolak ? 'disabled' : '' ?>>
                                                    Tolak
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>