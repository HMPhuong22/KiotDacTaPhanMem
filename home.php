<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello</h1>
    <?php
        $n = 10;
        $sum = 0;
        for($i = 0; $i<$n; $i++){
            if($i % 8 ==0 ){
                $sum+=$i;
                $i++;                
            }
        }
        echo "$n";
        echo "Tổng các số từ 1 đến 100 chia hết cho 8 = $sum";
    ?> 

    <h3>Viết PHP script để thực hiện tính tổng 2 số</h3>

    <form action="home.php" method="post">
        <input type="text" placehoder= "Nhap a" name="a"/>
        <input type="text" placehoder= "Nhap b" name ="b"/>
        <input type="submit" value="ket qua"/>
    <?php
        if(isset($_POST['a']) && ($_POST['b'])){
            $a = $_POST['a'];
            $b = $_POST['b'];
            $c = $a + $b;
            echo "<br> ket qua ".$c;
        }
    ?>
    </form>

    <div class="HCN">
        <h1>Tính chu vi và diện tích</h1>
        <form action="home.php" method="post">
        <input type="text" placehoder="nhap chieu dai" name="d">
        <input type="text" placehoder="nhap chieu rong" name="r">
        <?php
            $dai = $_POST['d'];
            $rong = $_POST['r'];
            $chuvi = ($dai + $rong)*2;
            $dientich = $dai * $rong;
        ?>
        <br>
        <input type="submit" value="ket qua"><br>
        <input type="text" value="<?php echo "$chuvi"; ?>">
        <input type="text" value="<?php echo "$dientich"; ?>"> 
    </div>
</body>
</html>