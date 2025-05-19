<?= $this->extend('layout/template-admin') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Profil</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
                    <h4 class="card-title">Edit Profil</h4>
                    <?php if (session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                <?php foreach (session()->getFlashdata('validation')->getErrors() as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error') && !session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>


                    <form action="/admin/profil/update" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo ($dataPengguna['username']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo ($dataPengguna['email']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Handphone</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo ($dataPengguna['no_telp']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo ($dataPengguna['alamat']) ?></textarea>
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
                            <label for="gambar">Foto Profil (biarkan kosong jika tidak ingin mengubah)</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>