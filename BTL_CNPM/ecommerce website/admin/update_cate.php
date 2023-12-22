<?php
require_once("../components/connect.php");
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("location:admin_login.php");
}

if (isset($_POST["update"])) {
    $cid = $_POST['cid'];
    $name_cate = $_POST['name_cate'];
    $name_cate = filter_var($name_cate, FILTER_SANITIZE_STRING);

    $update_category = $conn->prepare("UPDATE `category` SET name = ? WHERE id = ?");
    $update_category->execute([$name_cate, $cid]);

    $message[] = 'Cập nhật thành công!';

    $old_image_01 = $_POST['old_image_01'];
    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    if (!empty($image_01)) {
        if ($image_size_01 > 2000000) {
            $message[] = 'File ảnh quá lớn!';
        } else {
            $update_image_01 = $conn->prepare("UPDATE `category` SET icon = ? WHERE id = ?");
            $update_image_01->execute([$image_01, $cid]);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            unlink('../uploaded_img/' . $old_image_01);
            $message[] = 'Cập nhật icon danh mục thành công!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật danh mục</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.scss">
</head>

<body>
    <?php
    require_once('../components/admin_header.php');
    ?>
    <section class="update-product">
        <h1 class="heading">Cập nhật danh mục</h1>
        <?php
        $update_id = $_GET['update'];
        $select_cate = $conn->prepare("SELECT * FROM `category` WHERE id=?");
        $select_cate->execute([$update_id]);
        if ($select_cate->rowCount() > 0) {
            while ($fetch_cate = $select_cate->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="cid" value="<?= $fetch_cate['id']; ?>">
                    <input type="hidden" name="old_image_01" value="<?= $fetch_cate['icon']; ?>">
                    <span>Tên danh mục</span>
                    <input type="text" class="box" name="name_cate" value="<?= $fetch_cate['name']; ?>">
                    <span>Icon danh mục</span>
                    <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
                    <br>
                    <input type="submit" name="update" id="update" value="Update" class="btn">
                </form>

        <?php
            }
        } else {
            echo "<p>Lỗi không thể hiển thị danh mục!</p>";
        }
        ?>
    </section>
</body>

</html>