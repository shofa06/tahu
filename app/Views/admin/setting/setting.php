<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Pengaturan Aplikasi</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pengaturan Aplikasi</h4>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/admin/setting/save/'.$dataSetting['id_setting']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="no_hp">Nomor Telepon</label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= old('no_hp', $dataSetting['no_hp'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= old('email', $dataSetting['email'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" required><?= old('alamat', $dataSetting['alamat'] ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
