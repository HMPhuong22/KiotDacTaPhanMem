<?php
    require_once("connectDatabase.php");
    //if($_SERVER("REQUEST_METHOD") == "GET" && isset($_GET['ma'])){
        $idUpdate = $_GET['ma'];
        $query = "SELECT * FROM infomation WHERE masv = $idUpdate";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="updateStudent.php" method="POST">
                <input type="hidden" name="ma" value="<?php echo $row['masv']; ?>">
                <!-- Thêm các trường biểu mẫu khác ở đây, ví dụ: -->
                <input type="text" name="hoten" value="<?php echo $row['hoten']; ?>">
                <input type="text" name="gioitinh" value="<?php echo $row['gioitinh']; ?>">
                <input type="text" name="quequan" value="<?php echo $row['quequan']; ?>">
                <input type="text" name="sdt" value="<?php echo $row['sdt']; ?>">
                <input type="text" name="java" value="<?php echo $row['java']; ?>">
                <input type="text" name="php" value="<?php echo $row['php']; ?>">
                <!-- Thêm các trường khác -->
                <button type="submit">Lưu</button>
            </form>
<?php
        }
        header('infomation.php');
    $conn->close();
?>