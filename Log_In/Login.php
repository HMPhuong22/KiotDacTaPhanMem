<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <title>Login</title>
</head>
<body>
    <?php
        $username = "";
        $PASS = "";
        $idUserName= "Ha Minh Phuong";
        $idPass = "Haminhphuong22";
        $error = "";
        $done = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $PASS = $_POST['password'];
            $cmpUserName = strcmp($idUserName, $username);
            $cmpPass = strcmp($idPass, $PASS);

            if($cmpUserName === 0 && $cmpPass === 0){
                header('Location: http://localhost/giaiptbac2.php');
            }
            else{
                $error = "Tài khoản hoặc mật khẩu không chính xác";
            }
        }
    ?>
    <div class="container">
            <form method="POST" action="login.php">
                <h2>Đăng Nhập</h2>
                <div class="input-container">
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <label for="username">Tên người dùng</label>
                </div>
                <div class="input-container">
                    <input type="password" name="password" value="<?php echo $PASS; ?>">
                    <label for="password">Mật khẩu</label>                  
                </div>
                <button type="submit">Đăng Nhập</button>
                <span><?php echo $error; ?></span>
                <span><?php echo $done; ?></span>
            </form>
        </div>
</body>
</html>