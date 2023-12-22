<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="thongtin.php" method="post">
        <label for="">Mã Sinh Viên: </label>
        <input type="text" name="id"><br>
        <label for="">Họ Tên: </label>
        <input type="text" name="hoten"><br>
        <label for="">Giới Tính: </label>
        <input type="text" name="gioitinh"><br>
        <label for="">Quê Quán: </label>
        <input type="text" name="quequan"><br>
        <label for="">Điểm PHP: </label>
        <input type="text" name="php"><br>
        <label for="">Điểm Java: </label>
        <input type="text" name="java"><br>
        <input type="submit" value="Done">
    </form>

    <?php
        require_once("sinhvien.php");
        require_once("sinhvienIT.php");

        $id = "";
        $hoten = "";
        $gioitinh = "";
        $quequan = "";
        $diemphp = "";
        $diemjava = "";
        if(!isset($_POST['id'] && $_POST['hoten'] && $_POST['gioitinh'] && $_POST['quequan'] && $_POST['php'] && $_POST['java'])){
            $id = $_POST['id'];
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $quequan = $_POST['quequan'];
            $diemphp = $_POST['php'];
            $diemjava = $_POST['java'];
            return 0;
        }
        
        echo $id.'-'.$hoten.'-'.$gioitinh.'-'.$quenquan.'-'.$diemphp.'-'.$diemjava; 
    ?>
</body>
</html>