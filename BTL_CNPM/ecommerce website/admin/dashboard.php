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

      <h2 class="heading">Tình hình kinh doanh</h2>
      <div class="box-container" style="grid-template-columns: repeat(auto-fit, minmax(40rem, 1fr));">

         <div class="box">
            <?php
            $total_import = 0;
            $select_import = $conn->prepare("SELECT * FROM `import`");
            $select_import->execute();
            if ($select_import->rowCount() > 0) {
               while ($fetch_import = $select_import->fetch(PDO::FETCH_ASSOC)) {
                  $total_import += $fetch_import['import_price'] * $fetch_import['quantity'];
               }
            }
            ?>
            <h3 style="color: #e03"><i class="fa-solid fa-caret-down" style="padding-right: 8px"></i><span>$</span><?= $total_import; ?></h3>
            <div class="outer-bar" style="width: 100%;height: 5px;background-color: #e03;"></div>
            <p>Tổng tiền nhập</p>
            <!-- <a href="products.php" class="btn">see import</a> -->
         </div>
         <div class="box">
            <?php
            $target_amount = 500; // Mục tiêu số tiền (VD: 500$)
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ? AND YEAR(last_modified_date) = YEAR(CURRENT_DATE()) AND MONTH(last_modified_date) = MONTH(CURRENT_DATE())");
            $select_completes->execute(['completed']);
            if ($select_completes->rowCount() > 0) {
               while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                  $total_completes += $fetch_completes['total_price'];
               }
            }
            $percentage = ($total_completes / $target_amount) * 100; // Tính phần trăm
            ?>
            <h3 style="color: #00ab0e">
               <i class="fa-solid fa-caret-up" style="padding-right: 8px"></i>
               <span>$</span><?= $total_completes; ?>
            </h3>
            <div class="outer-bar" style="width: 100%;height: 5px;background-color: lightgray;">
               <!-- <div class="inner-bar" style="height: 100%; background-image: linear-gradient(to right, green <?= $percentage ?>%, transparent <?= $percentage ?>%);"></div> -->
               <div class="inner-bar" style="height: 100%; background: linear-gradient(to right, rgba(253,187,45,1) 0%, rgba(34,193,195,1) <?= $percentage ?>%, transparent <?= $percentage ?>%);"></div>
            </div>
            <p>
               Hoàn thành
               <?php echo number_format($percentage, 2, '.', ''); ?>% mục tiêu tháng
            </p>
         </div>
      </div>
      <div class="box-container" style="grid-template-columns: repeat(auto-fit, minmax(35rem, 1fr)); margin-top: 20px">

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
            <h3><span>$</span><?= $total_pendings; ?><span></span></h3>
            <p>Số đơn chờ xử lý</p>
            <a href="placed_orders.php" class="btn">Xem đơn đặt</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>Tổng số đơn hàng</p>
            <a href="placed_orders.php" class="btn">Xem đơn đặt</a>
         </div>
         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `import`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>Tổng số đơn nhập</p>
            <a href="import.php" class="btn">Xem đơn nhập</a>
         </div>

      </div>
      <h2 class="heading">Quản lý ứng dụng</h2>
      <div class="box-container" id="app">
         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
            ?>
            <h3><?= $number_of_products; ?></h3>
            <p>Tổng số sản phẩm</p>
            <a href="products.php" class="btn">Quản lý sản phẩm</a>
         </div>
         <div class="box">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `category`");
            $select_cate->execute();
            $number_of_cates = $select_cate->rowCount()
            ?>
            <h3><?= $number_of_cates; ?></h3>
            <p>Danh mục</p>
            <a href="cate.php" class="btn">Quản lý danh mục</a>
         </div>
         <div class="box">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `storage`");
            $select_cate->execute();
            $number_of_cates = $select_cate->rowCount()
            ?>
            <h3><?= $number_of_cates; ?></h3>
            <p>Kho</p>
            <a href="storage.php" class="btn">Quản lý kho</a>
         </div>
         <div class="box">
            <?php
            $select_cate = $conn->prepare("SELECT * FROM `application`");
            $select_cate->execute();
            $number_of_cates = $select_cate->rowCount()
            ?>
            <h3><?= $number_of_cates; ?></h3>
            <p>Banner QC</p>
            <a href="banner.php" class="btn">Quản lý banners</a>
         </div>
      </div>
      <h2 class="heading">Quản lý người dùng</h2>
      <div class="box-container">
         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
            ?>
            <h3><?= $number_of_users; ?></h3>
            <p>Tài khoản người dùng</p>
            <a href="users_accounts.php" class="btn">Quản lý người dùng</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
            ?>
            <h3><?= $number_of_admins; ?></h3>
            <p>Tài khoản admin</p>
            <a href="admin_accounts.php" class="btn">Quản lý Admin</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
            ?>
            <h3><?= $number_of_messages; ?></h3>
            <p>Tin nhắn</p>
            <a href="messagess.php" class="btn">Quản lý tin nhắn</a>
         </div>
      </div>


   </section>
   <?php
   $tinhdoanhthu = $conn->prepare("SELECT MONTH(placed_on) AS month, Sum(total_price) As dk FROM orders where payment_status = 'completed'");
   $tinhdoanhthu->execute();
   $data = array();

   while ($row = $tinhdoanhthu->fetch(PDO::FETCH_ASSOC)) {
      $data[] = [$row['month'], (int)$row['dk']];
   }

   // Chuyển đổi mảng PHP thành mảng JSON
   $data_json = json_encode($data);
   ?>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {
         'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'Tháng');
         data.addColumn('number', 'Doanh thu');

         // Thay dữ liệu này bằng dữ liệu thực tế từ cơ sở dữ liệu
         data.addRows(<?php echo $data_json; ?>);

         var options = {
            title: 'Biểu đồ doanh thu theo tháng',
            curveType: 'function',
            legend: {
               position: 'bottom'
            }
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
         chart.draw(data, options);
      }
   </script>

   <div id="chart_div" style="width: 900px; height: 500px;"></div>











   <script src="../js/admin_script.js"></script>

</body>

</html>