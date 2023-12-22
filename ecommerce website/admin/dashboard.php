<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="dashboard">

      <h1 class="heading">dashboard</h1>

      <h2 class="heading">Business status</h2>
      <div class="box-container">

         

         <div class="box">
            <?php
            $total_import = 0;
            $select_import = $conn->prepare("SELECT * FROM `products`");
            $select_import->execute();
            if ($select_import->rowCount() > 0) {
               while ($fetch_import = $select_import->fetch(PDO::FETCH_ASSOC)) {
                  $total_import += $fetch_import['import_price'] * $fetch_import['quantity'];
               }
            }
            ?>
            <h3 style="color: #e03"><i class="fa-solid fa-caret-down" style="padding-right: 8px"></i><span>$</span><?= $total_import; ?></h3>
            <p>Import</p>
            <a href="products.php" class="btn">see import</a>
         </div>
         <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if ($select_completes->rowCount() > 0) {
               while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                  $total_completes += $fetch_completes['total_price'];
               }
            }
            ?>
            <h3 style="color: #00ab0e"><i class="fa-solid fa-caret-up" style="padding-right: 8px"></i><span>$</span><?= $total_completes; ?></h3>
            <p>completed orders</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if ($select_pendings->rowCount() > 0) {
               while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
            ?>
            <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
            <p>total pendings</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>orders placed</p>
            <a href="placed_orders.php" class="btn">see orders</a>
         </div>

      </div>
      <h2 class="heading">Product</h2>
      <div class="box-container">
         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
            ?>
            <h3><?= $number_of_products; ?></h3>
            <p>Number of products</p>
            <a href="products.php" class="btn">see products</a>
         </div>
         <div class="box">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `category`");
            $select_cate->execute();
            $number_of_cates = $select_cate->rowCount()
            ?>
            <h3><?= $number_of_cates; ?></h3>
            <p>Category</p>
            <a href="cate.php" class="btn">see categories</a>
         </div>
         <div class="box">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `storage`");
            $select_cate->execute();
            $number_of_cates = $select_cate->rowCount()
            ?>
            <h3><?= $number_of_cates; ?></h3>
            <p>Storage</p>
            <a href="storage.php" class="btn">see Storages</a>
         </div>
      </div>
      <h2 class="heading">User management</h2>
      <div class="box-container">
      <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
            ?>
            <h3><?= $number_of_users; ?></h3>
            <p>normal users</p>
            <a href="users_accounts.php" class="btn">see users</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
            ?>
            <h3><?= $number_of_admins; ?></h3>
            <p>admin users</p>
            <a href="admin_accounts.php" class="btn">see admins</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
            ?>
            <h3><?= $number_of_messages; ?></h3>
            <p>new messages</p>
            <a href="messagess.php" class="btn">see messages</a>
         </div>
      </div>


   </section>












   <script src="../js/admin_script.js"></script>

</body>

</html>