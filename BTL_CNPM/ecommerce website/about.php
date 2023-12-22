<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.scss">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>

         <div class="content">
            <h3>Lý do để chọn chúng tôi?</h3>
            <p>Cửa hàng trực tuyến của chúng tôi nổi bật vì nhiều lý do:</p>

            <p><span style="font-weight: 700">  Sản phẩm chất lượng:</span> Chúng tôi chỉ bán trực tuyến xe đạp chất lượng cao từ các thương hiệu có uy tín, nổi tiếng về sản xuất những chiếc xe bền bỉ và đáng tin cậy.
            </p>
            <p><span style="font-weight: 700"> Hỗ trợ khách hàng chuyên nghiệp:</span> Đội ngũ đại diện hỗ trợ khách hàng thân thiện và hiểu biết sẵn sàng hỗ trợ 24/7.
            </p>
            <p><span style="font-weight: 700"> Chính sách hoàn trả:</span> Chúng tôi có chính sách hoàn trả dễ dàng cho phép bạn trả lại xe đạp của mình trong một khung thời gian cụ thể trong trường hợp xe không đáp ứng mong đợi của bạn hoặc có bất kỳ khiếm khuyết nào.
            </p>
            <a href="contact.php" class="btn">Liên hệ hỗ trợ</a>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="heading">Đánh giá dịch vụ</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `review` r LEFT JOIN `users` u ON r.user_id = u.id LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <div class="swiper-slide slide">
                     <img src="./images/OIP.jpeg" alt="">
                     <p><?= $fetch_product['review'] ?></p>
                     <?php
                     switch ($fetch_product['star']) {
                        case '0': ?>
                           <div class="stars">
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                           </div>
                        <?php break;
                        case '1': ?>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                           </div>
                        <?php break;
                        case '2': ?>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                           </div>
                        <?php break;
                        case '3': ?>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                           </div>
                        <?php break;
                        case '4': ?>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fa-regular fa-star"></i>
                           </div>
                        <?php break;
                        case '5': ?>
                           <div class="stars">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                           </div>
                     <?php break;
                     } ?>
                     <h3><?= $fetch_product['name'] ?></h3>
                     <p><?= $fetch_product['email'] ?></p>
                  </div>
            <?php }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            } ?>
            <!-- <div class="swiper-slide slide">
               <img src="images/pic-2.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-4.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-5.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-6.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>john deo</h3>
            </div> -->

         </div>

         <div class="swiper-pagination"></div>

      </div>
      <a href="review.php" class="btn">Đánh giá</a>

   </section>









   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>