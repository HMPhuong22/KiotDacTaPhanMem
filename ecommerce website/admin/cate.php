<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];



if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_category'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/' . $image_01;

   $select_cate = $conn->prepare("SELECT * FROM `category` WHERE name = ?");
   $select_cate->execute([$name]);

   if ($select_cate->rowCount() > 0) {
      $message[] = 'Category name already exist!';
   } else {

      $insert_category = $conn->prepare("INSERT INTO `category`(name, icon) VALUES(?, ?)");
      $insert_category->execute([$name, $image_01]);
      if ($insert_category) {
         if ($image_size_01 > 2000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            $message[] = 'new product added!';
         }
      }
   }
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE category_id = ?");
   $select_products->execute([$delete_id]);
   
   if ($select_products->rowCount() > 0) {
      $message[] = 'Products belong to this category exist! Can not delete';
   } else {
      $fetch_delete_image = $select_products->fetch(PDO::FETCH_ASSOC);
      unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
      $delete_product = $conn->prepare("DELETE FROM `category` WHERE id = ?");
      $delete_product->execute([$delete_id]);
      header('location:cate.php');
   };
}

// Sửa
if (isset($_GET['update'])) {
   $edit_id = $_GET['update'];
   $update_category = $conn->prepare("SELECT * FROM `category` WHERE category_id=?");  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">add Category</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Category name (required)</span>
               <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
            </div>
            <div class="inputBox">
               <span>Image 01 (required)</span>
               <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
         </div>

         <input type="submit" value="add category" class="btn" name="add_category">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">category list</h1>

      <div class="box-container" style="display: block">

         <?php
         $select_category = $conn->prepare("SELECT * FROM `category`");
         $select_category->execute();
         if ($select_category->rowCount() > 0) {
            while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box" style="width: 100%; display: flex; justify-content: space-between; padding: 1rem">
                  <div class="name"><?= $fetch_category['name']; ?></div>
                  <div class="flex-btn">
                     <a href="update_product.php?update=<?= $fetch_category['id']; ?>" class="option-btn" style="margin:0">update</a>
                     <a href="cate.php?delete=<?= $fetch_category['id']; ?>" class="delete-btn" onclick="return confirm('delete this category?');" style="margin:0">delete</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no category added yet!</p>';
         }
         ?>

      </div>

   </section>








   <script src="../js/admin_script.js"></script>

</body>

</html>