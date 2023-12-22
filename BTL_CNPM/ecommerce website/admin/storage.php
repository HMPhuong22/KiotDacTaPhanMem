<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];



if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_storage'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);


   $select_storage = $conn->prepare("SELECT * FROM `storage` WHERE name = ?");
   $select_storage->execute([$name]);

   if ($select_storage->rowCount() > 0) {
      $message[] = 'Storage name already exist!';
   } else {

      $insert_storage = $conn->prepare("INSERT INTO `storage`(name) VALUES(?)");
      $insert_storage->execute([$name]);
      $message[] = 'New storage added!';
   }
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE storage_id = ?");
   $select_products->execute([$delete_id]);
   if ($select_products->rowCount() > 0) {
      $message[] = 'Products belong to this storage exist! Can not delete';
   } else {

      $delete_product = $conn->prepare("DELETE FROM `storage` WHERE id = ?");
      $delete_product->execute([$delete_id]);
      header('location:cate.php');
   };
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kho hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">Tạo kho hàng</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Tên kho (bắt buộc)</span>
               <input type="text" class="box" required maxlength="100" placeholder="Nhập tên kho" name="name">
            </div>
         </div>

         <input type="submit" value="Thêm mới kho hàng" class="btn" name="add_storage">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">Danh sách kho</h1>

      <div class="box-container" style="display: block">

         <?php
         $select_storage = $conn->prepare("SELECT * FROM `storage`");
         $select_storage->execute();
         if ($select_storage->rowCount() > 0) {
            while ($fetch_storage = $select_storage->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box" style="width: 100%; display: flex; justify-content: space-between; padding: 1rem">
                  <div class="name"><?= $fetch_storage['name']; ?></div>
                  <div class="flex-btn">
                     <a href="update_storage.php?update=<?= $fetch_storage['id']; ?>" class="option-btn" style="margin:0">update</a>
                     <a href="cate.php?delete=<?= $fetch_storage['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa kho này?');" style="margin:0">delete</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có ko được thêm vào!</p>';
         }
         ?>

      </div>

   </section>








   <script src="../js/admin_script.js"></script>

</body>

</html>