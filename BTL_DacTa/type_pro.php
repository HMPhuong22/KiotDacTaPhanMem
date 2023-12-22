<?php
    require("connect.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
            try{
                $size = $_POST['size'];
                $color = $_POST['color'];
                $query_typePro = "INSERT INTO `chitietdtsp`(kichthuoc, mausac) 
                                    VALUES(?, ?)";
                $stmt = $conn->prepare($query_typePro);
                $stmt->execute([$size, $color]);

                header("Location:Product.php");
            }
            catch(PDOException $ex){
                echo "Error: ".$ex->getMessage();
            }
        }
    }
?>