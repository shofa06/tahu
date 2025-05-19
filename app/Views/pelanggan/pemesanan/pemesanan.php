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
                  <li class="nav-item active">
                     <a class="nav-link" href="">Profile</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="pesan-produk">Pesan Produk</a>
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
      <div class="banner_section layout_padding">
         <div class="container">
            <div id="banner_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                           <div class="banner_taital_main">
                              <h5 class="tasty_text">Tahu Bakso Crispy</h5>
                              <p class="banner_text"> "Gurihnya Nampol, Crispy-nya Bikin Nagih!" </p>
                              <div class="btn_main">
                                 <div class="about_bt"><a href="pesan-produk">Pesan Sekarang</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


               </div>

            </div>
         </div>
      </div>
      <!-- banner section end -->
   </div>
   <!-- header section end -->
   <!-- coffee section start -->
   <div class="coffee_section layout_padding">
      <div class="container">
         <div class="row">
            <h1 class="coffee_taital">PRODUK KITA</h1>
            <div class="bulit_icon"><img src="/template-pelanggan/images/bulit-icon.png"></div>
         </div>
      </div>
      <div class="coffee_section_2">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container-fluid">
                     <div class="row">
                        <?php foreach ($dataProduk as $produk) : ?>
                           <div class="col-lg-3 col-md-6">
                              <div class="coffee_img">
                                 <img class="uniform-img" src="/uploads/produk/<?php echo $produk['gambar'] ?>" alt="Produk">
                              </div>
                              <h3 class="types_text"><?php echo $produk['nama_produk'];
                                                      echo $produk['nama_kategori']  ?></h3>
                              <p class="looking_text">RP <?php echo $produk['harga'] ?></p>
                           </div>
                        <?php endforeach; ?>

                     </div>
                  </div>
               </div>


            </div>

         </div>
      </div>
   </div>
   <!-- coffee section end -->
   <!-- about section start -->
   <div class="about_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h1 class="about_taital">About Our shop</h1>
               <div class="bulit_icon"><img src="/template-pelanggan/images/bulit-icon.png"></div>
            </div>
         </div>
         <div class="about_section_2 layout_padding">
            <div class="image_iman"><img src="/template-pelanggan/images/about-img.png" class="about_img"></div>
            <div class="about_taital_box">
               <h1 class="about_taital_1">Tahu Bakso Crispy</h1>
               <p class=" about_text">Kedai Tahu Bakso Crispy merupakan usaha yang bergerak di bidang kuliner dengan sajian utama berupa Tahu Bakso Crispy yang renyah di luar dan lezat di dalam. Berlokasi di Kecamatan Bati-Bati, kedai kami hadir untuk menyajikan camilan favorit keluarga dengan cita rasa khas dan kualitas terbaik.
                  Sejak awal berdiri, kami berkomitmen untuk menghadirkan produk yang tidak hanya menggugah selera, tetapi juga higienis dan dibuat dari bahan-bahan pilihan. Tahu Bakso Crispy kami telah menjadi favorit banyak pelanggan,Dengan semangat terus berkembang dan melayani, Kedai Tahu Bakso Crispy siap menjadi pilihan utama bagi pecinta camilan gurih dan crispy.. </p>
            </div>
         </div>
      </div>
   </div>
   <!-- about section end -->
   <!-- client section start -->


   <!-- blog section end -->
   <!-- contact section start -->
   <!-- contact section end -->
   <!-- footer section start -->
   <div class="footer_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h1 class="address_text">Alamat</h1>
               <p class="footer_text">Jalan A. Yani, Desa Padang, Bati - Bati, Bati Bati, Tanah Laut, Kabupaten Tanah Laut, Kalimantan Selatan 70853</p>
               <div class="location_text">
                  <ul>
                     <li>
                        <a href="">
                           <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">089653264586</span>
                        </a>
                     </li>
                     <li>
                        <a href="https://www.instagram.com/tahubakso.crispy_?igsh=dHdyZWJkMmZ5ajY1&utm_source=qr" target="_blank">
                           <i class="fa fa-instagram" aria-hidden="true"></i><span class="padding_left_10">@tahubakso.crispy_</span>
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
            <p class="copyright_text">Copyright by <a href="https://html.design">Noor Shofa Safila</a></p>

         </div>
      </div>
   </div>
   <!-- copyright section end -->
   <!-- Javascript files-->
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