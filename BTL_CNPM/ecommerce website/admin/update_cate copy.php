<?php
require_once("../components/connect.php");
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("location:admin_login.php");
}

if (isset($_POST["update"])) {
    $bid = $_POST['bid'];
    $main_title = $_POST['main_title'];
    $main_title = filter_var($main_title, FILTER_SANITIZE_STRING);
    $sub_title = $_POST['sub_title'];
    $sub_title = filter_var($sub_title, FILTER_SANITIZE_STRING);

    $update_category = $conn->prepare("UPDATE `banner` SET main_title = ?, sub_title = ? WHERE id = ?");
    $update_category->execute([$main_title,$sub_title, $bid]);

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
            $update_image_01 = $conn->prepare("UPDATE `banner` SET image = ? WHERE id = ?");
            $update_image_01->execute([$image_01, $bid]);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            unlink('../uploaded_img/' . $old_image_01);
            $message[] = 'Cập nhật ảnh thành công!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật banner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.scss">
</head>

<body>
    <?php
    require_once('../components/admin_header.php');
    ?>
    <section class="update-product">
        <h1 class="heading">Cập nhật banner</h1>
        <?php
        $update_id = $_GET['update'];
        $select_cate = $conn->prepare("SELECT * FROM `application` WHERE id=?");
        $select_cate->execute([$update_id]);
        if ($select_cate->rowCount() > 0) {
            while ($fetch_cate = $select_cate->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="bid" value="<?= $fetch_cate['id']; ?>">
                    <input type="hidden" name="old_image_01" value="<?= $fetch_cate['image']; ?>">
                    <span>Tiêu đề chính</span>
                    <input type="text" class="box" name="main_title" value="<?= $fetch_cate['main_title']; ?>">
                    <span>Tiêu đề phụ</span>
                    <input type="text" class="box" name="sub_title" value="<?= $fetch_cate['sub_title']; ?>">
                    <span>Ảnh</span>
                    <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
                    <br>
                    <input type="submit" name="update" id="update" value="Update" class="btn">
                </form>

        <?php
            }
        } else {
            echo "<p>Lỗi không thể hiển thị banner!</p>";
        }
        ?>
    </section>
</body>

</html>