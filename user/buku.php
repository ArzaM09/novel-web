<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include '../components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Buku</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>
   <?php include '../components/user_header.php'; ?>
   <div class="heading">
      <h3>Novel Kami</h3>
      <p><a href="beranda.php">Beranda</a> <span> / Buku</span></p>
   </div>
   <section class="products">

      <h1 class="title">Novel Kami</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="deskripsi.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="kategori.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Rp</span><?= $fetch_products['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"">
         </div>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">Belum Ada Produk Lainnya!</p>';
         }
      ?>

   </div>

</section>
<?php include '../components/footer.php'; ?>
<script src=" ../js/script.js"></script>
</body>

</html>