<?php 
    require('connect.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['signin'])){
            $name = $_POST['account'];
            $sdthoai = $_POST['numberphone'];
            $mk = $_POST['pass'];
            $cmk = $_POST['passC'];

            // Kiểm tra trùng tên đăng nhập và số điện thoại
            // $sql = 'SELECT * FROM users WHERE ten_tk = ? and sdt = ?';
            // $result = $conn->prepare($sql);
            // $result->execute([$name, $sdthoai]);
            $sql = 'SELECT * FROM users';
            $result = $conn->prepare($sql);

                    if($result->rowCount() > 0){
                        echo "Tài khoản đã tồn tại";
                        //header("showError.html");
                    }
                    else{
                        if($mk != $cmk){
                            $message[] = "Mật khẩu không trùng khớp";
                            header("showError.html");              
                        }else{
                            $fix = "ALTER TABLE users AUTO_INCREMENT = 1";
                            $query_users = "INSERT INTO `users`(ten_tk, sdt, pass) 
                                            VALUES(?, ?, ?)";
                            $stmt = $conn->prepare($fix); 
                            $stmt->execute();
                            $stmt = $conn->prepare($query_users);
                            $stmt->execute([$name, $sdthoai, $mk]);
                            header("Location:index.html");  
                        }
                    }
                }
            }
    //     }
    // }

    // đóng kết nối với cơ sở dữ liệu
    //$conn = NULL;
?>