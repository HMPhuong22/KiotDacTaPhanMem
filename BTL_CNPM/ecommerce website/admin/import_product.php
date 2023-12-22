<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['update'])) {

   $pid = $_POST['pid'];
   $ip_price = $_POST['ip_price'];
   $ip_price = filter_var($ip_price, FILTER_SANITIZE_STRING);
   $qty = $_POST['quantity'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $select_products->execute([$pid]);
   $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
   $total_qty = $fetch_products["quantity"] + $qty;
   $update_product = $conn->prepare("UPDATE `products` SET quantity = ? WHERE id = ?");
   $update_product->execute([$total_qty, $pid]);

   $insert_import = $conn->prepare("INSERT INTO `import`(pid, import_price, quantity) VALUES(?,?,?)");
   $insert_import->execute([$pid, $ip_price, $qty]);

   $message[] = 'product updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="update-product">

      <h1 class="heading">Nhập hàng</h1>

      <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT p.id, p.name, p.image_01, p.image_02, p.image_03, i.import_price FROM `products` p LEFT JOIN `import` i ON p.id=i.pid WHERE p.id = ?");
      $select_products->execute([$update_id]);
      if ($select_products->rowCount() > 0) {
         while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <form action="" method="post" enctype="multipart/form-data">
               <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
               <div class="image-container">
                  <div class="main-image">
                     <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                  </div>
                  <div class="sub-image">
                     <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                     <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                     <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
                  </div>
               </div>
               <!-- <span>Tên sản phẩm</span>
               <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>"> -->
               <h2><?= $fetch_products['name']; ?></h2>
               <span>Giá nhập</span>
               <input type="number" min="0" class="box" required max="9999999999" placeholder="enter import price" onkeypress="if(this.value.length == 10) return false;" name="ip_price" value="<?= $fetch_products['import_price']; ?>">
               <span>Số lượng </span>
               <input type="number" min="0" class="box" required max="99" placeholder="enter product quantity" onkeypress="if(this.value.length == 3) return false;" name="quantity" value="">
               <input type="submit" name="update" class="btn" value="update">
               <a href="products.php" class="option-btn">Quay lại</a>
               </div>
            </form>

      <?php
         }
      } else {
         echo '<p class="empty">no product found!</p>';
      }
      ?>

   </section>

   










   <script src="../js/admin_script.js"></script>

</body>

</html>