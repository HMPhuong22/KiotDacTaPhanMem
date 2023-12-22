<?php
require('connect.php');

// Xử lý Update sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        try {
            $upid = $_POST['Upid'];
            $uten = $_POST['Uten'];
            $ugia = $_POST['Ugia'];
            $umota = $_POST['Umota'];
            $ukhohang = $_POST['Ukhohang'];
            
            $qry_Update = "UPDATE sanpham SET ten_sanpham = ?, gia_sanpham = ?, mota_sanpham = ?, ID_khohang = ? WHERE ID_sanpham = ?";
            $stmt = $conn->prepare($qry_Update);
            $stmt->execute([$uten, $ugia, $umota, $ukhohang, $upid]);
            
            // Upload ảnh
            $oldimage = $_POST['oldImg'];
            $uimg = $_FILES['Uimage']['name'];
            $file_tmp = $_FILES['Uimage']['tmp_name'];
            $query_update_newImg = "UPDATE sanpham SET anh = ? WHERE ID_sanpham = ?";
            $updateImg = $conn->prepare($query_update_newImg);
            $updateImg->execute([$uimg, $upid]);
            move_uploaded_file($file_tmp, $uimg);  
            unlink($oldimage);

            header("Location: show_pro.php");   
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="Update.css">

</head>

<body>
    <?php
    
    if(isset($_GET['idUpdate'])){
    // lấy ra ID của sản phẩm
    $getID_pro = $_GET['idUpdate'];
    // }
    // else{
    //     echo 'Không có khóa này trong mảng';
    // }
    $queryShowPro = "SELECT * FROM dactrungsanpham
        JOIN sanpham on dactrungsanpham.ID_sanpham = sanpham.ID_sanpham
        JOIN khohang on khohang.ID_khohang = sanpham.ID_khohang
        JOIN loaihang on loaihang.ID_loaihang = sanpham.ID_loaihang 
        JOIN chitietdtsp on chitietdtsp.ID_CTDTSP = dactrungsanpham.ID_CTDTSP
        WHERE sanpham.ID_sanpham = " . $getID_pro;
    $result = $conn->query($queryShowPro);
    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
    ?>
        <form action="Update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="Upid" value="<?= $row['ID_sanpham']; ?>">
            <!-- <img src="<?= $row['anh'];?>" alt="" width="200px" name="oldImg"><br> -->
            <input type="hidden" name="oldImg"><img src="<?= $row['anh'];?>" alt="" width="200px" name="oldImg"></input><br>
            <label for="fname">Tên sản phẩm:</label><br>
            <input type="text" id="Uten" name="Uten" value="<?php echo $row["ten_sanpham"]; ?>"><br>
            <label for="lname">Giá sản phẩm:</label><br>
            <input type="text" id="Ugia" name="Ugia" value="<?php echo $row["gia_sanpham"]; ?>"><br>
            <label for="lname">Loại sản phẩm:</label><br>
            <select name="Uloai" id="Uloai">
                <?php
                $sql_tLoaihang = "SELECT * FROM loaihang";
                $result_tLoaihang = $conn->prepare($sql_tLoaihang);
                $result_tLoaihang->execute();
                if ($result_tLoaihang->rowCount() > 0) {
                    while ($row_tLoaihang = $result_tLoaihang->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <option <?= $row_tLoaihang['ID_loaihang'] ?> value="<?= $row_tLoaihang['ID_loaihang'] ?>"><?= $row_tLoaihang['ten_loaihang'] ?></option>
                    <?php
                    } 
                    ?>
            </select><br>
            <!-- <input type="text" id="Uloai" name="Uloai" value="<?php echo $row["ten_loaihang"]; ?>"><br> -->
            <label for="lname">Thuộc tính:</label><br>
            <select name="Uthuoctinh" class="form-select">
                <?php
                    $sql_tChitietdtsp = "SELECT * FROM chitietdtsp";
                    $result_tChitietdtsp = $conn->prepare($sql_tChitietdtsp);
                    $result_tChitietdtsp->execute();
                    if ($result_tChitietdtsp->rowCount() > 0) {
                        while ($row_tChitietdtsp = $result_tChitietdtsp->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <option <?= $row_tChitietdtsp['ID_CTDTSP'] ?> value="<?= $row['kichthuoc'] . " - " . $row['mausac'] ?>"><?= $row_tChitietdtsp['kichthuoc'] . " - " . $row_tChitietdtsp['mausac'] ?></option>
                <?php
                        }
                    }
                ?>
            </select><br>
            <!-- <input type="text" id="Uthuoctinh" name="Uthuoctinh" value="<?php echo $row["kichthuoc"] . " - " . $row['mausac']; ?>"><br> -->
            <label for="lname">Mô tả:</label><br>
            <input type="text" id="Umota" name="Umota" value="<?php echo $row["mota_sanpham"]; ?>"><br>
            <label for="lname">Kho hàng:</label><br>
            <select name="Ukhohang" id="">
                <?php
                    $sql_tKhohang = "SELECT * FROM khohang";
                    $result_tKhohang = $conn->prepare($sql_tKhohang);
                    $result_tKhohang->execute();
                    if ($result_tKhohang->rowCount() > 0) {
                        while ($row_tKhohang = $result_tKhohang->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <option <?= $row_tKhohang['ID_khohang'] ?> value="<?= $row_tKhohang['ID_khohang'] ?>"><?= $row_tKhohang['diachi'] ?></option>
            <?php
                        }   
                    }
                }
            ?>
            </select><br>
            <!-- <input type="text" id="Ukhohang" name="Ukhohang" value="<?php echo $row["diachi"]; ?>"><br> -->
            <label for="lname">Số lượng:</label><br>
            <input type="text" id="Usoluong" name="Usoluong" value="<?php echo $row["soluong"]; ?>"><br><br>
            <div>
                <label for="" class="form-label">Thêm ảnh sản phẩm: </label>
                <input type="file" name="Uimage" accept="anh/*" class="form-control"?>
            </div><br>
            <input id="save" type="submit" value="Lưu" name="update">
        </form>
    <?php
    }}
    ?>

</body>

</html>

