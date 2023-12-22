<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];



if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $qty = $_POST['quantity'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $ip_price = $_POST['ip_price'];
   $ip_price = filter_var($ip_price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $storage = $_POST['storage'];
   $storage = filter_var($storage, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/' . $image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/' . $image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/' . $image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'Sản phẩm đã tồn tại!';
   } else {

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, quantity, price, image_01, image_02, image_03, category_id, storage_id) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $qty, $price, $image_01, $image_02, $image_03, $category, $storage]);


      if ($insert_products) {
         if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
            $message[] = 'Kích cỡ file ảnh quá lớn!';
         } else {
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'Thêm mới sản phẩm thành công!';
         }
      }
   }
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);
   $product = $select_products->fetch(PDO::FETCH_ASSOC);
   $product_id = $product['id'];
   $insert_import = $conn->prepare("INSERT INTO `import`(pid, import_price, quantity) VALUES(?,?,?)");
   $insert_import->execute([$product_id, $ip_price, $qty]);
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
   unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
   unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quản lý sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.scss">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="add-products">

      <h1 class="heading">Thêm mới sản phẩm</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <span>Tên sản phẩm (bắt buộc)</span>
               <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
            </div>
            <div class="inputBox">
               <span>Giá nhập (bắt buộc)</span>
               <input type="number" min="0" class="box" required max="9999999999" placeholder="enter import price" onkeypress="if(this.value.length == 10) return false;" name="ip_price">
            </div>
            <div class="inputBox">
               <span>Số lượng (bắt buộc)</span>
               <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product quantity" onkeypress="if(this.value.length == 10) return false;" name="quantity">
            </div>
            <div class="inputBox">
               <span>Giá bán (bắt buộc)</span>
               <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
            <div class="inputBox">
               <span>Ảnh 01 (bắt buộc)</span>
               <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Ảnh 02 (bắt buộc)</span>
               <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Ảnh 03 (bắt buộc)</span>
               <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            <div class="inputBox">
               <span>Mô tả (bắt buộc)</span>
               <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
            <div class="inputBox">
               <span>Danh mục (bắt buộc)</span>
               <select name="category" class="select">
                  <?php
                  $select_cate = $conn->prepare("SELECT * FROM `category`");
                  $select_cate->execute();
                  if ($select_cate->rowCount() > 0) {
                     while ($fetch_cate = $select_cate->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $fetch_cate['id'] ?>"><?= $fetch_cate['name'] ?></option>
                  <?php }
                  } ?>
               </select>
            </div>
            <div class="inputBox">
               <span>Kho (bắt buộc)</span>
               <select name="storage" class="select">
                  <?php
                  $select_stor = $conn->prepare("SELECT * FROM `storage`");
                  $select_stor->execute();
                  if ($select_stor->rowCount() > 0) {
                     while ($fetch_stor = $select_stor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $fetch_stor['id'] ?>"><?= $fetch_stor['name'] ?></option>
                  <?php }
                  } ?>
               </select>
            </div>


         </div>

         <input type="submit" value="Thêm sản phẩm" class="btn" name="add_product">
      </form>

   </section>

   <section class="show-products">

      <h1 class="heading">Danh sách sản phẩm</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                  <div class="name" style="font-size: 2rem; font-weight: 600; overflow:hidden; height: 78px"><span><?= $fetch_products['name']; ?></span></div>
                  <div class="name">Số lượng: <?= $fetch_products['quantity']; ?></div>
                  <!-- <div class="price" style="color: #e03">Giá nhập: $<span><?= $fetch_products['import_price']; ?></span></div> -->
                  <div class="price">Giá bán: $<span><?= $fetch_products['price']; ?></span></div>
                  <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                  <div class="flex-btn">
                     <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Cập nhật</a>
                     <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Xóa</a>
                     
                  </div>
                  <div class="flex-btn">
                     <a href="import_product.php?update=<?= $fetch_products['id']; ?>" class="btn">Nhập hàng</a>
                  </div>

               </div>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm được thêm vào!</p>';
         }
         ?>

      </div>

   </section>








   <script src="../js/admin_script.js"></script>

</body>

</html>