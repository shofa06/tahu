<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Lokasi</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/lokasi">Lokasi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Lokasi</li>
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
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Tambah Lokasi</h4>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="/admin/lokasi/simpan" method="post">
                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" required>
                        </div>

                        <div class="form-group">
                            <label for="jarak_tempuh">Jarak Tempuh (KM)</label>
                            <input type="number" class="form-control" id="jarak_tempuh" name="jarak_tempuh" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="ongkir">Ongkir (Rp)</label>
                            <input type="number" class="form-control" id="ongkir" name="ongkir" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/admin/lokasi" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
