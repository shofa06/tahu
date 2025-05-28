<?= $this->extend('layout/template-pelanggan') ?>
<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="coffee_section layout_padding">
    
    <div class="coffee_section_2">
        <div class="container-fluid">
            <form id="formOrder" method="POST" action="/order">
                <div class="row">
                    <?php
                    
                    foreach ($dataProduk as $produk) : ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card produk-card shadow-sm h-100"
                                data-id="<?= $produk['id_produk'] ?>"
                                data-nama="<?= $produk['nama_produk'] ?>">
                                <img class="card-img-top uniform-img" src="/uploads/produk/<?= $produk['gambar'] ?>" alt="<?= $produk['nama_produk'] ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $produk['nama_produk'] ?> - <?= $produk['nama_kategori'] ?></h5>
                                    <p class="card-text text-success font-weight-bold">Rp <?= $produk['harga'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4 mb-4">
                    <button type="button" class="btn btn-success btn-lg shadow" onclick="bukaModalOrder()">
                        <i class="fa fa-shopping-cart"></i> Order Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Order -->
<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="modalOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 rounded-lg">
            <form method="POST" action="/pelanggan/pesan-produk/order" >
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalOrderLabel"><i class="fa fa-check-circle"></i> Konfirmasi Pesanan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">Silakan masukkan jumlah untuk setiap produk yang Anda pilih:</p>
                    <div id="listProdukDipilih"></div>

                    <hr>

                    <!-- Pilihan metode pengiriman -->
                    <div class="form-group">
                        <label for="jenisPengiriman">Pilih Metode Pengiriman</label>
                        <select id="jenisPengiriman" name="jenis_pengiriman" class="form-control" required>
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="antar">Antar</option>
                            <option value="ambil">Ambil di Tempat</option>
                        </select>
                    </div>

                    <!-- Lokasi pengiriman dan alamat, hanya tampil jika antar -->
                    <div id="formAntar" style="display: none;">
                        <div class="form-group mt-3">
                            <label for="lokasiPengiriman">Pilih Lokasi Pengiriman</label>
                            <select id="lokasiPengiriman" name="lokasi_pengiriman" class="form-control">
                                <option value="" selected disabled>-- Pilih Lokasi --</option>
                                <?php foreach ($dataLokasi as $lokasi) : ?>
                                    <option
                                        value="<?= esc($lokasi['id_lokasi']) ?>"
                                        data-ongkir="<?= esc($lokasi['ongkir']) ?>"
                                        data-jarak="<?= esc($lokasi['jarak_tempuh']) ?>">
                                        <?= esc($lokasi['nama_lokasi']) ?> - Rp<?= number_format($lokasi['ongkir'], 0, ',', '.') ?> (<?= esc($lokasi['jarak_tempuh']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Ongkos Kirim:</label>
                            <p id="hargaOngkir" style="font-weight:bold; font-size:1.2rem; color:#28a745;">Rp0</p>
                            <input type="hidden" name="ongkir" id="inputOngkir" value="0">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>


<!-- Gaya khusus -->
<style>
    .uniform-img {
        height: 180px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    .produk-card {
        cursor: pointer;
        transition: 0.3s;
    }
    .produk-card.selected {
        border: 3px solid #28a745;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
    }
</style>

<!-- Tempat tombol untuk bayar -->
<button id="pay-button" class="btn btn-primary" style="display:none;">Bayar Sekarang</button>

<!-- Script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('SB-Mid-client-BeF9O5Kqr6iNxW9J') ?>"></script>

<script>
    // Tangkap snapToken dari flashdata PHP
    const snapToken = '<?= session()->getFlashdata('snapToken') ?? '' ?>';

    if (snapToken) {
        // Tampilkan tombol bayar jika ada snapToken
        document.getElementById('pay-button').style.display = 'inline-block';

        // Saat tombol diklik, panggil Snap popup
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay(snapToken, {
                onSuccess: function(result){
                    alert('Pembayaran berhasil!');
                    // Redirect atau update halaman sesuai kebutuhan
                    window.location.href = "/pelanggan/pesanan-keranjang/";
                },
                onPending: function(result){
                    alert('Pembayaran pending. Silakan lanjutkan pembayaran.');
                },
                onError: function(result){
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function(){
                    alert('Anda menutup popup pembayaran.');
                }
            });
        });

        // Otomatis klik tombol bayar jika kamu ingin langsung muncul popup-nya:
        document.getElementById('pay-button').click();
    }
</script>

<script>
    let produkDipilih = [];

    function bukaModalOrder() {
        const container = document.getElementById('listProdukDipilih');
        container.innerHTML = '';

        if (produkDipilih.length === 0) {
            alert("Silakan pilih minimal satu produk.");
            return;
        }

        produkDipilih.forEach((produk, index) => {
            container.innerHTML += `
                <div class="form-group">
                    <label><strong>${produk.nama}</strong></label>
                    <input type="hidden" name="produk[${index}][id]" value="${produk.id}">
                    <input type="number" name="produk[${index}][jumlah]" class="form-control" placeholder="Jumlah Porsi" required min="1">
                </div>
            `;
        });

        // Reset form metode pengiriman setiap kali modal dibuka
        $('#jenisPengiriman').val('');
        $('#formAntar').hide();
        $('#inputOngkir').val(0);
        $('#hargaOngkir').text("Rp0");

        $('#modalOrder').modal('show');
    }

    $(document).ready(function () {
        // Event: Klik produk
        $('.produk-card').on('click', function () {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const index = produkDipilih.findIndex(p => p.id === id);

            if (index > -1) {
                produkDipilih.splice(index, 1);
                this.classList.remove('selected');
            } else {
                produkDipilih.push({ id, nama });
                this.classList.add('selected');
            }
        });

        // Event: Ubah jenis pengiriman
        $('#jenisPengiriman').on('change', function () {
            if (this.value === 'antar') {
                $('#formAntar').slideDown();
            } else {
                $('#formAntar').slideUp();
                $('#inputOngkir').val(0);
                $('#hargaOngkir').text("Rp0");
            }
        });

        // Event: Ubah lokasi pengiriman
        $('#lokasiPengiriman').on('change', function () {
            let ongkir = $('option:selected', this).data('ongkir') || 0;
            $('#inputOngkir').val(ongkir);
            $('#hargaOngkir').text('Rp' + ongkir.toLocaleString('id-ID'));
        });
    });
</script>


<?= $this->endSection() ?>
