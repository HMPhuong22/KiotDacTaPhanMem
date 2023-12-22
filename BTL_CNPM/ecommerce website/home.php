<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/wishlist_cart.php';

$page_size = 6; // Số lượng dữ liệu trên mỗi trang
$page_index = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại

$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
$total_count = $select_products->rowCount();
$page_total = ceil($total_count / $page_size); // Số trang được tính dựa trên tổng số dữ liệu và số lượng dữ liệu trên mỗi trang
// echo $page_total;
$start = (intval($page_index) - 1) * $page_size; // Vị trí bắt đầu lấy dữ liệu
$data = $conn->prepare("SELECT * FROM `products` LIMIT ? OFFSET ?");
$data->bindValue(1, $page_size, PDO::PARAM_INT);
$data->bindValue(2, $start, PDO::PARAM_INT);
$data->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop bán xe đạp</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.scss">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="swiper home-slider">

            <div class="swiper-wrapper">
               <?php
               $select_banner = $conn->prepare("SELECT * FROM `application` LIMIT 6");
               $select_banner->execute();
               if ($select_banner->rowCount() > 0) {
                  while ($fetch_banner = $select_banner->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <div class="swiper-slide slide">
                        <div class="image">
                           <img src="uploaded_img/<?= $fetch_banner["image"] ?>" alt="">
                        </div>
                        <div class="content">
                           <span><?= $fetch_banner["sub_title"] ?></span>
                           <h3><?= $fetch_banner["main_title"] ?></h3>
                           <a href="#section" class="btn">Mua ngay</a>
                        </div>
                     </div>
               <?php }
               } ?>
               <!-- <div class="swiper-slide slide">
                  <div class="image">
                     <img src="images/home-img-2.png" alt="">
                  </div>
                  <div class="content">
                     <span>upto 50% off</span>
                     <h3>latest watches</h3>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div> -->

            </div>

            <div class="swiper-pagination"></div>

         </div>

      </section>

   </div>

   <section class="category">

      <h1 class="heading">Danh mục sản phẩm</h1>

      <div class="swiper category-slider">

         <div class="swiper-wrapper">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `category`");
            $select_cate->execute();
            if ($select_cate->rowCount() > 0) {
               while ($fetch_cate = $select_cate->fetch(PDO::FETCH_ASSOC)) {
            ?>

                  <a href="category.php?category=<?= $fetch_cate['id'] ?>" class="swiper-slide slide">
                     <img src="./uploaded_img/<?= $fetch_cate['icon'] ?>" alt="">
                     <h3><?= $fetch_cate['name'] ?></h3>
                  </a>

            <?php }
            } ?>
            <!-- <a href="category.php?category=tv" class="swiper-slide slide">
               <img src="images/icon-2.png" alt="">
               <h3>Xe đạp đạp đạp</h3>
            </a>-->

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="home-products">
      <h1 class="heading">Sản phẩm mới nhất</h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE quantity != 0 LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <form action="" method="post" class="swiper-slide slide <?php if ($fetch_product['quantity'] == 0) {
                                                                              echo 'disabled';
                                                                           }; ?>">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <?php if ($fetch_product['quantity'] > 9) { ?>
                        <span class="stock" style="color: green;"><i class="fas fa-check"></i> Còn hàng</span>
                     <?php } elseif ($fetch_product['quantity'] == 0) { ?>
                        <span class="stock" style="color: red;"><i class="fas fa-times"></i> Hết hàng</span>
                     <?php } else { ?>
                        <span class="stock" style="color: red;">Chỉ còn <?= $fetch_product['quantity']; ?> sản phẩm</span>
                     <?php } ?>
                     <div class="name" style="font-size: 2rem; font-weight: 600; overflow:hidden; height: 70px"><span><?= $fetch_product['name']; ?></span></div>
                     <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_product['price']; ?><span></span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <?php if ($fetch_product['quantity'] > 0) {
                     ?><input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
                     <?php } ?>
                  </form>
            <?php
               }
            } else {
               echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
            }
            ?>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="products">

      <h1 class="heading" id="section">Sản phẩm nổi bật</h1>

      <div class="box-container">

         <?php
         // $select_products = $conn->prepare("SELECT * FROM `products`");
         // $select_products->execute();
         if ($data->rowCount() > 0) {
            while ($fetch_product = $data->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box <?php if ($fetch_product['quantity'] == 0) {
                                                            echo 'disabled';
                                                         }; ?>">
                  <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                  <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                  <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                  <?php if ($fetch_product['quantity'] > 9) { ?>
                     <span class="stock" style="color: green;"><i class="fas fa-check"></i> Còn hàng</span>
                  <?php } elseif ($fetch_product['quantity'] == 0) { ?>
                     <span class="stock" style="color: red;"><i class="fas fa-times"></i> Hết hàng</span>
                  <?php } else { ?>
                     <span class="stock" style="color: red;">Chỉ còn <?= $fetch_product['quantity']; ?> sản phẩm</span>
                  <?php } ?>
                  <div class="name" style="font-size: 2rem; font-weight: 600; overflow:hidden; height: 78px"><span><?= $fetch_product['name']; ?></span></div>
                  <div class="flex">
                     <div class="price"><span>$</span><?= $fetch_product['price']; ?><span></span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>

                  <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">

               </form>

            <?php
            }
            ?>

         <?php } else {
            echo '<p class="empty">Không tìm thấy sản phẩm!</p>';
         }
         ?>

      </div>
      <div class="paging">
         <a class="page <?php if ($page_index == 1) {
                           echo 'disabled';
                        }; ?>" href='?page=1#section' style='font-size: 2rem;color: #2980b9;border: 1px solid #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><i class="fa-solid fa-angles-left"></i></a>
         <a class="page <?php if ($page_index == 1) {
                           echo 'disabled';
                        }; ?>" href='?page=<?= $page_index - 1 ?>#section' style='font-size: 2rem;color: #2980b9;border: 1px solid #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><i class="fa-solid fa-angle-left"></i></a>
         <?php
         for ($i = 1; $i <= $page_total; $i++) {
            if ($i == $page_index) {
         ?> <span style='font-weight:bold; font-size: 2rem;color: #fff;background-color: #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><?= $i ?></span>
            <?php } else {
            ?> <a href='?page=<?= $i ?>#section' style='font-size: 2rem;color: #2980b9;border: 1px solid #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><?= $i ?></a>
         <?php }
         } ?>
         <a class="page <?php if ($page_index == $page_total) {
                           echo 'disabled';
                        }; ?>" href='?page=<?= $page_index + 1 ?>#section' style='font-size: 2rem;color: #2980b9;border: 1px solid #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><i class="fa-solid fa-angle-right"></i></a>
         <a class="page <?php if ($page_index == $page_total) {
                           echo 'disabled';
                        }; ?>" href='?page=<?= $page_total ?>#section' style='font-size: 2rem;color: #2980b9;border: 1px solid #2980b9;border-radius: 4px; padding: 5px 13px; margin-right:8px'><i class="fa-solid fa-angles-right"></i></a>
      </div>

   </section>







   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>