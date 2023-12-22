<?php
    require_once ("../components/connect.php");
    session_start();
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header("location:admin_login.php");
    }

    if(isset($_POST["update"])){
        $sid = $_POST['sid'];
        $name_stor = $_POST['name_stor'];
        $name_stor = filter_var($name_stor, FILTER_SANITIZE_STRING);
        
        $update_category = $conn->prepare("UPDATE `storage` SET name = ? WHERE id = ?");
        $update_category->execute([$name_stor, $sid]);

        $message[] = 'update successfully!';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật kho</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.scss">
</head>
<body>
    <?php 
        require_once ('../components/admin_header.php');
    ?>
    <section class = "update-product">
        <h1 class="heading">Cập nhật kho</h1>
        <?php 
        $update_id = $_GET['update'];
        $select_cate = $conn->prepare("SELECT * FROM `storage` WHERE id=?");
        $select_cate->execute([$update_id]);
        if($select_cate->rowCount() > 0){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
            while($fetch_cate = $select_cate->fetch(PDO::FETCH_ASSOC)){
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="sid" value="<?= $fetch_cate['id']; ?>">
        <span>Tên kho</span>
        <input type="text" class="box" name="name_stor"  value="<?= $fetch_cate['name'] ; ?>">
        <br>
        <input type="submit" name="update" id="update" value="Update" class="btn">
    </form>

    <?php 
        }
    }else{
        echo "<p>Lỗi không thể hiển thị thông tin kho!</p>";
    }
    ?>
    </section>
</body>
</html>