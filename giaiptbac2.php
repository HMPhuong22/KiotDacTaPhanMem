<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải phương trình bậc 2</title>
</head>
<body>
    <h2>Giải phương trình trình bậc 2: ax^2 + bx + c = 0</h2>
    <form action="giaiptbac2.php" method="post">
        <input type="text" name="a">X^2 + 
        <input type="text" name="b">X + 
        <input type="text" name="c"> = 0
        <input type="submit" value="ketqua">
        <?php   
            include("giaipt.php");
            
            $x = "";
            $y = "";
            $z = "";
            if(isset($_POST['a'])){
                $x = $_POST['a'];
                $y = $_POST['b'];
                $z = $_POST['c'];

                giaipt($x, $y, $z);
            }
        ?>
    </form>
</body>
</html>

