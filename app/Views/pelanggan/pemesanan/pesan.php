<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Doze Cafe</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="template-pelanggan/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="template-pelanggan/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/template-pelanggan/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- font css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/template-pelanggan/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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



</head>

<body>
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.html"><img width="100px" src="/template-pelanggan/images/logotahu.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="pesan-produk">Pesan Produk</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="login_bt">
                            <ul>
                                <li><a href="/login"><span class="user_icon"><i class="fa fa-user" aria-hidden="true"></i></span>Login</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <!-- banner section start -->

        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- coffee section start -->
    <div class="coffee_section layout_padding">
        <div class="container">
            <div class="row">
                <h1 class="coffee_taital">PRODUK</h1>
                <div class="bulit_icon"><img src="/template-pelanggan/images/bulit-icon.png"></div>
            </div>
        </div>
        <div class="coffee_section_2">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container-fluid">
                            <form id="formOrder" method="POST" action="/order">
                                <div class="row">
                                    <?php foreach ($dataProduk as $produk) : ?>
                                        <div class="col-lg-3 col-md-6 mb-4">
                                            <div class="card produk-card shadow-sm h-100"
                                                data-id="<?php echo $produk['id_produk'] ?>"
                                                data-nama="<?php echo $produk['nama_produk'] ?>">
                                                <img class="card-img-top uniform-img" src="/uploads/produk/<?php echo $produk['gambar'] ?>" alt="Produk">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?php echo $produk['nama_produk']  ?> <?php echo $produk['nama_kategori'] ?></h5>
                                                    <p class="card-text text-success font-weight-bold">Rp <?php echo $produk['harga'] ?></p>
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

            </div>
        </div>
    </div>
    <!-- coffee section end -->
    <div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="modalOrderLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 rounded-lg">
                <form method="POST" action="/order">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalOrderLabel"><i class="fa fa-check-circle"></i> Konfirmasi Pesanan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Silakan masukkan jumlah untuk setiap produk yang Anda pilih:</p>
                        <div id="listProdukDipilih"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="address_text">Alamat</h1>
                    <p class="footer_text">Jalan A. Yani, Desa Padang, Bati - Bati, Bati Bati, Tanah Laut, Kabupaten Tanah Laut, Kalimantan Selatan 70853</p>
                    <div class="location_text">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">089653264586</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram" aria-hidden="true"></i><span class="padding_left_10">tahubakso.crispy</span>
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <div class="row">
                <p class="copyright_text">Copyright by <a href="https://html.design">Nur Shofa Shafilla</a></p>

            </div>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script>
const produkDipilih = [];

document.querySelectorAll('.produk-card').forEach(card => {
   card.addEventListener('click', function () {
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
});

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

   $('#modalOrder').modal('show');
}
</script>



    <script src="/template-pelanggan/js/jquery.min.js"></script>
    <script src="/template-pelanggan/js/popper.min.js"></script>
    <script src="/template-pelanggan/js/bootstrap.bundle.min.js"></script>
    <script src="/template-pelanggan/js/jquery-3.0.0.min.js"></script>
    <script src="/template-pelanggan/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="/template-pelanggan/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/template-pelanggan/js/custom.js"></script>
</body>

</html>