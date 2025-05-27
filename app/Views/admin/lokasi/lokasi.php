<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Lokasi</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lokasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Lokasi</h4>

                    <a href="/admin/lokasi/tambah" class="btn btn-primary mb-3">Tambah Lokasi</a>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Jarak Tempuh</th>
                                    <th>Ongkir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataLokasi)) : ?>
                                    <?php $no = 1; foreach ($dataLokasi as $item) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= esc($item['nama_lokasi']) ?></td>
                                            <td><?= esc($item['jarak_tempuh']) ?></td>
                                            <td>Rp <?= number_format($item['ongkir'], 0, ',', '.') ?></td>
                                            <td>
                                                <a href="/admin/lokasi/edit/<?= $item['id_lokasi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="/admin/lokasi/hapus/<?= $item['id_lokasi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data lokasi.</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
