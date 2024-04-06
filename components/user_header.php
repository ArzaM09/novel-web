<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="../user/beranda.php" class="logo">PRINCESS NOVEL</a>

      <nav class="navbar">
         <a href="beranda.php">Beranda</a>
         <a href="about.php">Tentang kami</a>
         <a href="buku.php">Daftar buku</a>
         <a href="pesanan.php">Pesanan</a>
         <a href="kontak.php">Kontak kami</a>
      </nav>

      <div class="icons">
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="keranjang.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
               <a href="profile.php" class="btn">Profil</a>
               <a href="../components/user_logout.php" onclick="return Konfirmasi('Anda ingin keluar?');" class="delete-btn">Keluar</a>
            </div>
            <p class="account">
               <a href="login.php">login</a> or
               <a href="register.php">registrasi</a>
            </p>
         <?php
         } else {
         ?>
            <p class="name">silahkan login terlebih dahulu</p>
            <a href="login.php" class="btn">login</a>
            <a href="../admin/admin_login.php" class="btn">Login Admin</a>
         <?php
         }
         ?>
      </div>

   </section>

</header>