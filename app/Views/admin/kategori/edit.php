<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Kategori</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/kategori">Kategori</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
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
                    <h4 class="card-title">Form Edit Kategori</h4>
                    <form action="/admin/kategori/update/<?php echo ($dataKategori['id_kategori']) ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value=""> <!-- isi ID kategori jika perlu -->
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo ($dataKategori['nama_kategori']) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/kategori" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
