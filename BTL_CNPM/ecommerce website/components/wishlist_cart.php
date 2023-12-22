<?php

if (isset($_POST['add_to_wishlist'])) {

   if ($user_id == '') {
      header('location:user_login.php');
   } else {

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$name, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if ($check_wishlist_numbers->rowCount() > 0) {
         $message[] = 'Đã thêm vào danh sách yêu thích!';
      } elseif ($check_cart_numbers->rowCount() > 0) {
         $message[] = 'Sản phẩm đã được thêm vào giỏ hàng!';
      } else {
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid, $name, $price, $image]);
         $message[] = 'Thêm vào danh sách yêu thích thành công!';
      }
   }
}

if (isset($_POST['add_to_cart'])) {

   if ($user_id == '') {
      header('location:user_login.php');
   } else {

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      $max_cart_limit = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $max_cart_limit->execute([$user_id]);
      if ($check_cart_numbers->rowCount() > 0) {
         $message[] = 'Sản phẩm đã có trong giỏ hàng!';
      } elseif ($max_cart_limit->rowCount() == 10) {
         $message[] = 'Giỏ hàng đã đầy!';
      } else {
         $select_p = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_p->execute([$pid]);
         $fetch_p = $select_p->fetch(PDO::FETCH_ASSOC);
         if ($qty > $fetch_p["quantity"]) {
            $message[] = 'Chỉ còn ' . $fetch_p['quantity'] . ' sản phẩm';
         } else {
            $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
            $check_wishlist_numbers->execute([$name, $user_id]);

            if ($check_wishlist_numbers->rowCount() > 0) {
               $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
               $delete_wishlist->execute([$name, $user_id]);
            }

            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
            $message[] = 'Thêm vào giỏ hàng thành công!';
         }
      }
   }
}
