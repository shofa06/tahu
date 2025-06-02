<?= $this->extend('layout/template-karyawan') ?>
<?= $this->section('content') ?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Pesanan</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Filter Data Pesanan</h4>
            <form method="get" action="<?= base_url('/karyawan/pesanan') ?>">
                <div class="row">
                    <div class="col-md-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= esc($_GET['tanggal'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-- Semua Bulan --</option>
                            <?php for ($m = 1; $m <= 12; $m++) : ?>
                                <option value="<?= $m ?>" <?= (isset($_GET['bulan']) && $_GET['bulan'] == $m) ? 'selected' : '' ?>>
                                    <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">-- Semua Tahun --</option>
                            <?php for ($y = date('Y'); $y >= 2020; $y--) : ?>
                                <option value="<?= $y ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $y) ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="<?= base_url('/karyawan/pesanan') ?>" class="btn btn-secondary ml-2">Reset</a>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABEL PESANAN -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kelola Data Pesanan</h4>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
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
                            <th>Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($dataPesanan as $pesanan) : ?>
                            <?php
                            $namaProduk = $jumlah = $harga = '';
                            foreach ($pesanan['detail'] as $detail) {
                                $namaProduk .= $detail['nama_produk'] . '<br>';
                                $jumlah .= $detail['jumlah'] . '<br>';
                                $harga .= 'Rp ' . number_format($detail['total_harga'], 0, ',', '.') . '<br>';
                            }

                            $status = strtolower($pesanan['status_pesanan']);
                            $pembayaran = strtolower($pesanan['pembayaran']);

                            $disableDiantar = ($status === 'diantar');
                            $disableSelesai = ($status === 'selesai');
                            $disableTolak = ($status === 'batal');

                            $badge = 'warning';
                            if ($pembayaran === 'diantar') $badge = 'info';
                            elseif ($pembayaran === 'selesai') $badge = 'success';
                            elseif ($pembayaran === 'batal') $badge = 'danger';
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $namaProduk ?></td>
                                <td><?= date('d-m-Y', strtotime($pesanan['tanggal_pemesanan'])) ?></td>
                                <td><?= $harga ?></td>
                                <td><?= $jumlah ?></td>
                                <td><span class="badge bg-<?= $badge ?> text-uppercase"><?= ucfirst($pembayaran) ?></span></td>
                                <td><?= ucfirst($pesanan['status_pesanan']) ?></td>
                                <td><?= $pesanan['alamat'] ?></td>
                                <td>
                                    <!-- Diantar -->
                                    <form action="/karyawan/pesanan/pembayaran/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="pembayaran" value="diantar">
                                        <button type="submit" class="btn btn-sm btn-info"
                                            onclick="return confirm('Yakin ingin mengubah status menjadi Diantar?')"
                                            <?= $disableDiantar ? 'disabled' : '' ?>>
                                            Diantar
                                        </button>
                                    </form>

                                    <!-- Selesai -->
                                    <form action="/karyawan/pesanan/pembayaran/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline; margin-left:5px;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="pembayaran" value="selesai">
                                        <button type="submit" class="btn btn-sm btn-success"
                                            onclick="return confirm('Yakin ingin menandai pesanan sebagai Selesai?')"
                                            <?= $disableSelesai ? 'disabled' : '' ?>>
                                            Selesai
                                        </button>
                                    </form>

                                    <!-- Tolak -->
                                    <form action="/karyawan/pesanan/pembayaran/<?= $pesanan['id_pesanan'] ?>" method="post" style="display:inline; margin-left:5px;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="pembayaran" value="batal">
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menolak pesanan ini?')"
                                            <?= $disableTolak ? 'disabled' : '' ?>>
                                            Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($dataPesanan)) : ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data pesanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
