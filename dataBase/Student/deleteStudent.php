<?php
    require_once("connectDatabase.php");
    $idSv = $_GET['ma'];
    $delete = "DELETE FROM infomation WHERE masv = '$idSv'";
    mysqli_query($conn, $delete);
?>
