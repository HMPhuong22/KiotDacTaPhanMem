<?php
    require_once("connectDatabase.php");
    //if($_SERVER("REQUEST_METHOD") == "GET" && isset($_GET['ma'])){
        $ma = $_POST['ma'];
        $hoten = $_POST['hoten'];
        $gioitinh = $_POST['gioitinh'];
        $quequan = $_POST['quequan'];
        $sdt = $_POST['sdt'];
        $java = $_POST['java'];
        $php = $_POST['php'];

        $queryUpdate = "UPDATE infomation SET hoten = '$hoten', gioitinh = '$gioitinh', quequan = '$quequan', sdt = '$sdt', 
        java = '$java', php = '$php' WHERE masv = '$ma'";

        if(mysqli_query($conn, $queryUpdate) === TRUE){
            echo 'Done';
            ?>
                <button><a href="infomationStudent.php">Quay Lại</a></button>
            <?php
        }
        else{
            echo 'False'.$conn->error;
        }
    $conn->close();
?>