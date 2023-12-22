<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<?php
    require_once("connectDatabase.php");
?>
<body>
    <div class="container mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Lớp</th>
                    <th>Khóa</th>
                    <th>Quê Quán</th>
                    <th>Số điện thoại</th>
                    <th>Điểm JAVA</th>
                    <th>Điểm PHP</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $selectData = "SELECT * FROM infomation";
            $result = $conn->query($selectData);
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    ?>                   
                    <tr>
                        <td><?php echo $rows["STT"]; ?></td>
                        <td><?php echo $rows["masv"]; ?></td>
                        <td><?php echo $rows["hoten"]; ?></td>
                        <td><?php echo $rows["gioitinh"]; ?></td>
                        <td><?php echo $rows["lop"]; ?></td>
                        <td><?php echo $rows["khoa"]; ?></td>
                        <td><?php echo $rows["sdt"]; ?></td>
                        <td><?php echo $rows["quequan"]; ?></td>
                        <td><?php echo $rows["java"]; ?></td>
                        <td><?php echo $rows["php"]; ?></td>
                        <td><a href="editStudent.php?ma=<?php echo $rows['masv']; ?>">Sửa</a></td>
                        <td><a href="deleteStudent.php?ma=<?php echo $rows['masv']; ?>">Xóa</a></td>
                    </tr>
                    <?php
                }
            }
            else{
                echo "No result";
            }

            $conn->close();
           
        ?>
        <button><a href="createStudent.php">Them</a></button>
            </tbody>
        </table>
    </div>
</body>
</html>