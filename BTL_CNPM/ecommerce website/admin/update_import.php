<?php
require_once("../components/connect.php");
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("location:admin_login.php");
}

if (isset($_POST["update"])) {
    $sid = $_POST['sid'];
    $ip_price = $_POST['ip_price'];
    $ip_price = filter_var($ip_price, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $old_qty = $_POST['old_qty'];
    $old_qty = filter_var($old_qty, FILTER_SANITIZE_STRING);
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $change = $old_qty - $qty;

    $select_p = $conn->prepare("SELECT *  FROM `products` WHERE id=?");
    $select_p->execute([$pid]);
    $fetch_p = $select_p->fetch(PDO::FETCH_ASSOC);
    if ($fetch_p["quantity"] + $change < 0) {
        $message[] = 'Không thể sửa phiếu nhập!';
    } else {
        $new_qty = $fetch_p['quantity'] + $change;

        $update_p = $conn->prepare("UPDATE `products` SET quantity = ? WHERE id = ?");
        $update_p->execute([$new_qty, $pid]);
        $update_ip = $conn->prepare("UPDATE `import` SET quantity = ?, import_price = ? WHERE id = ?");
        $update_ip->execute([$qty,$ip_price, $sid]);

        $message[] = 'update successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật phiếu nhập hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="../css/admin_style.scss">
</head>

<body>
    <?php
    require_once('../components/admin_header.php');
    ?>
    <section class="update-product">
        <h1 class="heading">Cập nhật phiếu nhập hàng</h1>
        <?php
        $update_id = $_GET['update'];
        $select_ip = $conn->prepare("SELECT i.*, p.name  FROM `import` i LEFT JOIN `products` p ON i.pid = p.id WHERE i.id=?");
        $select_ip->execute([$update_id]);
        if ($select_ip->rowCount() > 0) {
            while ($fetch_ip = $select_ip->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="sid" value="<?= $fetch_ip['id']; ?>">
                    <input type="hidden" name="old_qty" value="<?= $fetch_ip['quantity']; ?>">
                    <input type="hidden" name="pid" value="<?= $fetch_ip['pid']; ?>">
                    <h2><?= $fetch_ip['name']; ?></h2>
                    <span>Giá nhập</span>
                    <input type="text" class="box" name="ip_price" value="<?= $fetch_ip['import_price']; ?>">
                    <span>Số lượng</span>
                    <input type="text" class="box" name="qty" value="<?= $fetch_ip['quantity']; ?>">
                    <br>
                    <input type="submit" name="update" id="update" value="Update" class="btn">
                </form>

        <?php
            }
        } else {
            echo "<p>Lỗi không thể hiển thị thông tin kho!</p>";
        }
        ?>
    </section>
</body>

</html>