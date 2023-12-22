<?php
    require_once("connectDatebase.php");
    $sohocsinhtrenmoitrang = 4;
    if(isset($_GET['trang'])){
        $tranghientai = $_GET['trang'];
    }else{
        $tranghientai = 1;
    }

    $vitribatdau = ($tranghientai - 1) * $sohocsinhtrenmoitrang;

    $query = "SELECT * FROM infomation LIMIT $vitribatdau, $sohocsinhtrenmoitrang";
    mysqli_query($conn, $query);
    $tongketqua = 'SELECT COUTN(*) AS Num FROM infomation';
    $result = mysqli_query($conn, $tongketqua);
    $row = mysqli_fetch_assoc($result);
    $tongsinhvien = $tongketqua['$tongsinhvien'];
?>