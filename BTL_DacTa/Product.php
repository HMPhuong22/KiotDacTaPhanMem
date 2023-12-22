<?php require_once('connect.php'); 
use PhpParser\Node\Stmt\Echo_;?>

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
    <title>Danh sách sản phẩm</title>
</head>
<body>  
    <div class="container mt-3">
    <h1>Sản phẩm</h1><br>
    <div class="">
        <form action="Product.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="" class="form-label">Tên sản phẩm: </label>
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Loại đặc trưng sản phẩm: </label>
                <select name="loaidt" class="form-select">
                    <?php
                        $sql_tChitietdtsp = "SELECT * FROM chitietdtsp";
                        $result_tChitietdtsp = $conn->prepare($sql_tChitietdtsp);
                        $result_tChitietdtsp->execute();
                        if($result_tChitietdtsp->rowCount() > 0){
                            while ($row_tChitietdtsp=$result_tChitietdtsp -> fetch(PDO::FETCH_ASSOC)){
                                ?>
                                    <option <?=$row_tChitietdtsp['ID_CTDTSP']?> value="<?=$row_tChitietdtsp['ID_CTDTSP']?>"><?=$row_tChitietdtsp['kichthuoc']." - ".$row_tChitietdtsp['mausac']?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="" class="form-label">Số lượng: </label>
                <input type="number" name="quantity" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Nhập giá sản phẩm: </label>
                <input type="text" name="price" id="" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Thêm ảnh sản phẩm: </label>
                <input type="file" name="image" accept="anh/*" class="form-control">
            </div>
            <div>
                <label for="" class="form-label">Mô tả sản phẩm: </label>
                <input type="text" name="describe" class="form-control">
            </div>    
            <div>
                <label for="" class="form-label">Kho phân loại: </label>
                <select name="warehouse" id="" class="form-select">
                    <?php
                            $sql_tKhohang = "SELECT * FROM khohang";
                            $result_tKhohang = $conn->prepare($sql_tKhohang);
                            $result_tKhohang->execute();
                            if($result_tKhohang->rowCount() > 0){
                                while ($row_tKhohang=$result_tKhohang -> fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option <?=$row_tKhohang['ID_khohang']?> value="<?=$row_tKhohang['ID_khohang']?>"><?=$row_tKhohang['diachi']?></option>
                                    <?php
                                }
                            }
                        ?>
                </select>
            </div>  
            <div>
                <label for="">Loại hàng: </label>
                <select name="cate" id="" class="form-select">
                    <?php
                            $sql_tLoaihang = "SELECT * FROM loaihang";
                            $result_tLoaihang = $conn->prepare($sql_tLoaihang);
                            $result_tLoaihang->execute();
                            if($result_tLoaihang->rowCount() > 0){
                                while ($row_tLoaihang=$result_tLoaihang -> fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                        <option <?=$row_tLoaihang['ID_loaihang']?> value="<?=$row_tLoaihang['ID_loaihang']?>"><?=$row_tLoaihang['ten_loaihang']?></option>
                                    <?php
                                }
                            }
                        ?>
                </select>
            </div>
            <br><br>
            <input type="submit" value="Lưu sản phẩm" class="btn btn-primary" name="themsanpham"> 

            <?php 
                require("Add.php");
                
            ?>
            <button><a href="index.html">Quay lai trang chủ</a></button>
        </form>
    </div>
</div>
</body>
</html>