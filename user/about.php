<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>


   <?php include '../components/user_header.php'; ?>


   <div class="heading">
      <h3>Tentang Kami</h3>
      <p><a href="beranda.php">Beranda</a> <span> / Tentang</span></p>
   </div>



   <section class="about">

      <div class="row">

         <div class="image">
            <img src="../images/buku1.jpg" alt="">
         </div>

         <div class="content">
            <h3>Kenapa Harus Memilih Kami?</h3>
            <p>PRINCESS NOVEL menyediakan aneka novel berkualitas dan terlengkap. Nikmati novel harga murah dengan kualitas tidak murahan. Kenyamanan dan kepuasan para pelanggan merupakan prioritas kami. Kami ingin memberikan pengalaman yang lebih kepada para pelanggan di saat pelanggan melakukan proses pembelanjaan online, dengan terus mengembangkan fitur-fitur produk. Memberikan pelayanan yang terbaik menjadi tujuan kami dengan dukungan manajemen yang proaktif dan kreatif.</p>
            <a href="buku.php" class="btn">Novel Kami</a>
         </div>

      </div>

   </section>

   <section class="steps">

      <h1 class="title">Langkah Mudah</h1>

      <div class="box-container">

         <div class="box">
            <img src="../images/step-1.png" alt="">
            <h3>Pilih Pesanan</h3>
         </div>

         <div class="box">
            <img src="../images/step-2.png" alt="">
            <h3>Pengiriman Cepat</h3>
         </div>

         <div class="box">
            <img src="../images/baca.jpg" alt="">
            <h3>Selamat Membaca</h3>
         </div>

      </div>

   </section>
   <section class="reviews">

      <h1 class="title">Ulasan Pelanggan</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="../images/org5.jpg" alt="">
               <p>bukunya sesuai pesanan, mau beli lagi buat stok nungguin buka puasa hehe</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Wahdini</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="../images/pic-3.png" alt="">
               <p>bagus banget, original, next beli lagi bakal langganan disini</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Abdi</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="../images/org2.jpeg" alt="">
               <p>bukunya sampai dengan aman, harganya terjangkau, cepat juga pengirimannya</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>NURA</h3>
            </div>
         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   </section>
   <!-- footer section starts  -->
   <?php include '../components/footer.php'; ?>
   <!-- footer section ends -->=
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <!--js file link  -->
   <script src="../js/script.js"></script>
   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>