<?php 
    require("connect.php");
    if(isset($_GET['idDelete'])){
        try{
            $dl = $_GET['idDelete'];
            // Xóa sản phẩm trong bảng đặc trưng sản phẩm
            $qry_delete_dt = "DELETE FROM dactrungsanpham WHERE dactrungsanpham.ID_sanpham = ".$dl;
            $stmt = $conn->prepare($qry_delete_dt); 
            $stmt->execute();

            // Xóa sản phẩm trong bảng sản phẩm
            $qry_delete_pro = "DELETE FROM sanpham WHERE ID_sanpham = ".$dl;
            $stmt = $conn->prepare($qry_delete_pro); 
            $stmt->execute();
            
            // Chuyển hướng về Product.php
            header("Location: show_pro.php");
        }catch (PDOException $ex){  
            echo "Error: ".$ex->getMessage();
        }
    }
?>