<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];



if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_import = $conn->prepare("SELECT i.* FROM `import` i WHERE i.id = ?");
   $select_import->execute([$delete_id]);
   $fetch_import = $select_import->fetch(PDO::FETCH_ASSOC);
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $select_products->execute([$fetch_import["pid"]]);
   $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
   $product_qty = $fetch_product["quantity"] - $fetch_import["quantity"];

   if ($product_qty < 0) {
      $message[] = 'Không thể xóa hóa đơn do đã bán sản phẩm thuộc hóa đơn này!';
   } else {
      $update_product = $conn->prepare("UPDATE `products` SET quantity = ? WHERE id = ?");
      $update_product->execute([$product_qty, $fetch_import["pid"]]);

      $delete_import = $conn->prepare("DELETE FROM `import` WHERE id = ?");
      $delete_import->execute([$delete_id]);
      $message[] = 'Xóa thành công!';
      header('location:import.php');
   };
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý nhập hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <!-- <section class="add-products">

      <h1 class="heading">Thêm mới danh mục</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Tên danh mục (bắt buộc)</span>
               <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
            </div>
            <div class="inputBox">
               <span>Ảnh (bắt buộc)</span>
               <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
         </div>

         <input type="submit" value="add category" class="btn" name="add_category">
      </form>

   </section> -->

   <section class="show-products">

      <h1 class="heading">Danh sách hóa đơn nhập</h1>

      <div class="box-container" style="display: block">

         <?php
         $select_import = $conn->prepare("SELECT p.name, i.* FROM `import` i LEFT JOIN `products` p ON i.pid = p.id");
         $select_import->execute();
         if ($select_import->rowCount() > 0) {
            while ($fetch_import = $select_import->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <div class="name"><?= $fetch_import['name']; ?></div>
                  <div class="name">Số lượng: <?= $fetch_import['quantity']; ?></div>
                  <!-- <div class="price" style="color: #e03">Giá nhập: $<span><?= $fetch_import['import_price']; ?></span></div> -->
                  <div class="price">Giá nhập: $<span><?= $fetch_import['import_price']; ?></span></div>
                  <div class="price">Ngày nhập: <span><?= $fetch_import['created_date']; ?></span></div>
                  <div class="flex-btn">
                     <a href="update_import.php?update=<?= $fetch_import['id']; ?>" class="option-btn" style="margin:0">Cập nhật</a>
                     <a href="import.php?delete=<?= $fetch_import['id']; ?>" class="delete-btn" onclick="return confirm('Xóa hóa đơn nhập này?');" style="margin:0">Xóa</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có danh mục được thêm!</p>';
         }
         ?>

      </div>

   </section>








   <script src="../js/admin_script.js"></script>

</body>

</html>