<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="SignIn.css">
    <style>
        span{
            color:red;
        }
    </style>
</head>
<body>
    <form action="SignIn.php" method="POST"> 
    <?php 
            $USERNAME = "";
            $PASS = "";
            $PASS_REPEAT = "";

            $errorUserName = "";
            $errorPass = "";
            $errorPassRepeat = "";
            $errorCheckPatter = "";
            $errorCheck=""; 
            $done = "";
            $done2 = "";
            $errorCheck2 = "";


            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $USERNAME = $_POST['username'];
                $PASS = $_POST['password'];
                $PASS_REPEAT = $_POST['password-repeat'];
        
                $PASS_PATTER = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$/"; 
                
                $compare = strcmp($PASS, $PASS_REPEAT);

                if($USERNAME == ""){
                    $errorUserName = "Vui lòng nhập tên đăng nhập";
                }
                if($PASS == ""){
                    $errorPass = "Vui lòng nhập mật khẩu";
                }
                if($PASS_REPEAT == ""){
                    $errorPassRepeat = " Vui lòng xác nhận lại mật khẩu";
                }

                // So sánh biểu thức chính quy
                if(!preg_match($PASS_PATTER, $PASS, $PASS_REPEAT)){
                    $errorCheckPatter = "Nhập chưa đúng định dạng mật khẩu";
                }
                else{
                    $done2 = "Đăng ký thành công";
                }
                
                if($compare === 0){
                    $done2 = "Đăng ký thành công";
                }
                else{
                    $errorCheck2 = "Tài khoản mật khẩu không trùng khớp";
                }
            }
        ?> 
        <div class="register">                
            <h1>Đăng ký</h1>
            <p>Vui lòng điền thông tin để đăng ký</p>
            <hr>
            <label for="username"><b>Tên đăng nhập</b></label>
            <input type="text" placeholder="Họ và tên" name="username" value="<?php echo $USERNAME; ?>" require>
            <span><?php echo $errorUserName; ?></span><br>
            <label for="password"><b>Mật khẩu</b></label>
            <input type="password" placeholder="******" name="password" value="<?php echo $PASS; ?>">
            <span><?php echo $errorPass; ?></span><br>
            <span><?php echo $errorCheckPatter; ?></span><br>
            <label for="password-repeat"><b>Nhập lại mật khẩu</b></label>
            <input type="password" placeholder="******" name="password-repeat" value="">
            <span><?php echo $errorPassRepeat; ?></span><br>
            <span><?php echo $errorCheck2; ?></span><br>
            <span><?php echo $done2; ?></span><br>
            <hr>
            <button type="submit" class="submit">Đăng ký</button>
        </div>
        <div class="register login">
            <p>Bạn đã có tài khoản rồi? <a href="#">Đăng nhập</a>.</p>
        </div>   
    </form>
</body>
</html>