<?php

include '../components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:beranda.php');
};

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if (isset($_POST['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $message[] = 'deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Keranjang</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>
   <?php include '../components/user_header.php'; ?>
   <div class="heading">
      <h3>Keranjang Belanjaan</h3>
      <p><a href="beranda.php">Beranda</a> <span> / Keranjang</span></p>
   </div>
   <section class="products">

      <h1 class="title">Belanjaan Mu</h1>

      <div class="box-container">

         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <a href="deskripsi.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('delete this item?');"></button>
                  <img src="../uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Rp</span><?= $fetch_cart['price']; ?></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="sub-total"> sub total : <span>Rp<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
               </form>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>

      </div>

      <div class="cart-total">
         <p>total Harga : <span>Rp<?= $grand_total; ?></span></p>
         <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Lanjutkan Ke Pembayaran</a>
      </div>

      <div class="more-btn">
         <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('delete all from cart?');">Hapus Semua</button>
         </form>
         <a href="buku.php" class="btn">Lanjutkan Berbelanja</a>
      </div>

   </section>
   <?php include '../components/footer.php'; ?>
   <script src="../js/script.js"></script>
</body>

</html>