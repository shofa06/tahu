<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Lokasi</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/lokasi">Lokasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lokasi</li>
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
                    <h4 class="card-title">Form Edit Lokasi</h4>
                    <form action="/admin/lokasi/update/<?= $dataLokasi['id_lokasi'] ?>" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_lokasi" value="<?= $dataLokasi['id_lokasi'] ?>">

                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" value="<?= esc($dataLokasi['nama_lokasi']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="jarak_tempuh">Jarak Tempuh</label>
                            <input type="text" class="form-control" id="jarak_tempuh" name="jarak_tempuh" value="<?= esc($dataLokasi['jarak_tempuh']) ?>" required>
                        </div>


                        <div class="form-group">
                            <label for="ongkir">Ongkir</label>
                            <input type="number" class="form-control" id="ongkir" name="ongkir" value="<?= esc($dataLokasi['ongkir']) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/lokasi" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>