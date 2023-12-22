<?php  require("connect.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>Hiển thị sản phẩm</title>
</head>
<body>
<div class="container mt-3">
    <h1>Hiển thị sản phẩm</h1>
    <div>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Loại hàng</th>
                <th>Thuộc tính</th>       
                <th>Mô tả</th>
                <th>Số lượng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * from dactrungsanpham
                    JOIN sanpham on dactrungsanpham.ID_sanpham = sanpham.ID_sanpham
                    JOIN loaihang on loaihang.ID_loaihang = sanpham.ID_loaihang
                    JOIN chitietdtsp on chitietdtsp.ID_CTDTSP = dactrungsanpham.ID_CTDTSP";
            $result = $conn->prepare($sql);
            $result->execute();
            if($result->rowCount() > 0){
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                   ?>
                    <tr>
                        <td><img src="anh/<?= $row['anh'];?>" alt="" width="50px"></td>
                        <td><?=$row["ten_sanpham"] ?></td>
                        <td><?=$row["gia_sanpham"] ?></td>
                        <td><?=$row["ten_loaihang"] ?></td>
                        <td><?=$row["kichthuoc"]." - ".$row['mausac']?></td>
                        <td><?=$row["mota_sanpham"] ?></td>
                        <td><?=$row["soluong"] ?></td>  
                        <td>
                            <a href="Update.php?idUpdate=<?= $row['ID_sanpham']; ?>" class="fa fa-plus-square"></a>
                            <a href="Delete.php?idDelete=<?= $row['ID_sanpham']; ?>" class="fa fa-trash-o"></a>
                            <!-- <button value="<?php $row['ID_sanpham']; ?>"><i class="fa fa-trash-o"></i></button> -->
                        </td>
                    </tr>
                   <?php
                }
            }else{
                echo "Không có dữ liệu trong bảng";
            }
        ?>
        </tbody>
    </table><br><br><br>
    </div>
    <button><a href="Product.php">Thêm sản phẩm</a></button>
    <button><a href="index.html">Quay lai trang chủ</a></button>
    <footer>By Hà Minh Phương</footer>
</div>
</body>
</html>