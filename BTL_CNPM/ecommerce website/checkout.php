<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

$grand_total = 0;
$cart_items[] = '';
$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);


if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $subject = "ORDER IS BEING DELIVERED TO YOU";
   $mail_message = "Địa chỉ xác nhận: \r\n" . $address . "\r\n\r\nSản phẩm: \r\n" . $total_products . "\r\nTổng số tiền thanh toán:\r\n$" . $total_price . "\r\nPhương thức thanh toán:\r\n" . $method;
   $headers = "From: lsn@gmail.com\r\n";

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
      while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         $product_id = $fetch_cart["pid"];
         $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_product->execute([$product_id]);
         $product = $select_product->fetch(PDO::FETCH_ASSOC);
         $new_quantity = $product["quantity"] - $fetch_cart["quantity"];
         $update_stock = $conn->prepare("UPDATE `products` SET quantity = ? WHERE id = ?");
         $update_stock->execute([$new_quantity, $product_id]);
      }
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      if (mail($email, $subject, $mail_message, $headers)) {
         $message[] = 'Đặt hàng thành công!';
      } else {
         $message[] = 'Có lỗi xảy ra khi gửi email.';
      }
   } else {
      $message[] = 'Giỏ hàng rỗng';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.scss">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>Đơn hàng của bạn</h3>

         <div class="display-orders">
            <?php
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
                  <p> <?= $fetch_cart['name']; ?> <span>(<?= '$' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
            <?php
               }
            } else {
               echo '<p class="empty">Giỏ hàng rỗng!</p>';
            }
            ?>
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <div class="grand-total">Tổng tiền : <span>$<?= $grand_total; ?></span></div>
         </div>

         <h3>Thông tin nhận hàng</h3>

         <div class="flex">
            <div class="inputBox">
               <span>Họ và tên :</span>
               <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
               <span>SDT :</span>
               <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
            </div>
            <div class="inputBox">
               <span>Email :</span>
               <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Phương thức thanh toán :</span>
               <select name="method" class="box" required>
                  <option value="cash on delivery">Tiền mặt</option>
                  <option value="credit card">Thẻ tín dụng</option>
                  <option value="paytm">paytm</option>
                  <option value="paypal">paypal</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Số nhà :</span>
               <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Đường :</span>
               <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Thành phố :</span>
               <input type="text" name="city" placeholder="e.g. mumbai" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Tỉnh :</span>
               <input type="text" name="state" placeholder="e.g. maharashtra" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Quốc gia :</span>
               <input type="text" name="country" placeholder="e.g. India" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Mã bưu điện :</span>
               <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
            </div>
         </div>

         <input type="submit" name="order" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Đặt hàng">

      </form>

   </section>













   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>