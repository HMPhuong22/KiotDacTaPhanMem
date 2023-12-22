<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
 
    <form action="sinhvienshow.php" method="post">
        <?php
            require_once("sinhvien.php");
            require_once("sinhvienIT.php");
            $sever="localhost";
            $severname="root";
            $severpost= "";
            $conn = new mysqli($sever, $severname, $severpost);

            if($conn->connect_error){
                die("error: ".$conn->connect_error);
            }


            // $listsinhvien = [];
            // $listsinhvien[0] = new StudentIT(1, 'phuong', 'nam', 'HB', 9, 8);
            // $listsinhvien[1] = new StudentIT(2, 'trang', 'nu', 'HB', 10, 8);
            // $listsinhvien[2] = new StudentIT(3, 'hoang', 'nam', 'HB', 9, 8);
            // $listsinhvien[3] = new StudentIT(4, 'nam', 'nam', 'HB', 9, 8);

        //$listsinhvien[0]->setName('duc');

            $stt = "<form action=\"sinhvienshow.php\" method=\"post\">";
            $stt =  $stt."<input type=\"text\" name=\"ten\"> ";
            $stt =  $stt. "<input type=\"submit\" value=\"sua\">";
            $name = "";
            if(isset($_POST['ten'])){
                $name = $_POST['ten'];
                $listsinhvien[0]->setName(''.$name);
            } 
            $stt =  $stt. "</form>";

            $str = "<table style=\"border: 1px solid black \">";
                $str = $str."<tr>
                    <th style=\"border: 1px solid black \">Mã Sinh Viên</th>
                    <th style=\"border: 1px solid black \">Họ Tên</th>
                    <th style=\"border: 1px solid black \">Giới tính</th>
                    <th style=\"border: 1px solid black \">Địa Chỉ</th>
                    <th style=\"border: 1px solid black \">Điểm PHP</th>
                    <th style=\"border: 1px solid black \">Điểm Java</th> 
                    <th style=\"border: 1px solid black \">Điểm Trung Bình</th>
                </tr>";

            for($i = 0; $i < sizeof($listsinhvien); $i++){
                $str = $str . "<tr>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getID()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getName()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getGioitinh()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getDiachi()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getPHP()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->getJava()."</td>";
                $str = $str ."<td style=\"border: 1px solid black \">".$listsinhvien[$i]->DiemTB()."</td>";
                $str = $str . "</tr>";
            }
            
            // $dt =$listsinhvien[0]->setID( $this -> $ten); 
            $str = $str . "</table>";
            echo $stt;
            echo $str;
        ?>
    </form>
</body>
</html>