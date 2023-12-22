<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra số nguyên tố</title>
</head>
<body>
    <form  method="POST" action="function.php">
        <h2>Kiểm tra số nguyên tố trong PHP</h2>
        <input type="text" name="a">
        <input type="submit" value="ketqua">
    </form>
    <?php
    include("songuyento.php");

        $a = "";
        if(isset($_POST['a'])){
            $a = $_POST['a'];
            if(KtraSoNguyenTo($a)){
                echo $a.' là số nguyên tố';
            }
            else{
                echo $a.' không là số nguyên tố';
            }
        }
    ?>
</body>
</html>