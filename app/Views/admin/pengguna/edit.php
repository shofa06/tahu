<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Pengguna</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/pengguna">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
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
                    <h4 class="card-title">Form Edit Pengguna</h4>
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

                    <form action="/admin/pengguna/update/<?php echo ($dataPengguna['id_user']) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo ($dataPengguna['username']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo ($dataPengguna['email']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password (biarkan kosong jika tidak diubah)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo ($dataPengguna['no_telp']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"><?php echo ($dataPengguna['alamat']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="">-- Pilih Level --</option>
                                <option value="admin" <?php echo ($dataPengguna['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="karyawan" <?php echo ($dataPengguna['level'] == 'karyawan') ? 'selected' : ''; ?>>Karyawan</option>
                                <option value="pelanggan" <?php echo ($dataPengguna['level'] == 'pelanggan') ? 'selected' : ''; ?>>Pelanggan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Pengguna</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="/admin/pengguna" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>