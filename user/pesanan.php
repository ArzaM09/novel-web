<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:beranda.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>
   <?php include '../components/user_header.php'; ?>
   <div class="heading">
      <h3>Pesanan</h3>
      <p><a href="beranda.php">Beranda</a> <span> / Pesanan</span></p>
   </div>

   <section class="orders">

      <h1 class="title">Pesanan Mu</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">Tolong Login Untuk Melakukan Pemesanan</p>';
         } else {
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
                  <div class="box">
                     <p>Pada Tanggal : <span><?= $fetch_orders['placed_on']; ?></span></p>
                     <p>nama : <span><?= $fetch_orders['name']; ?></span></p>
                     <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                     <p>nomor : <span><?= $fetch_orders['number']; ?></span></p>
                     <p>alamat : <span><?= $fetch_orders['address']; ?></span></p>
                     <p>Metode Pembayaran : <span><?= $fetch_orders['method']; ?></span></p>
                     <p>Pesanan Mu : <span><?= $fetch_orders['total_products']; ?></span></p>
                     <p>total Harga : <span>Rp<?= $fetch_orders['total_price']; ?>/-</span></p>
                     <p>Status Pembayaran : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                  echo 'red';
                                                               } else {
                                                                  echo 'green';
                                                               }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>

   </section>
   <?php include '../components/footer.php'; ?>
   <script src="../js/script.js"></script>

</body>

</html>