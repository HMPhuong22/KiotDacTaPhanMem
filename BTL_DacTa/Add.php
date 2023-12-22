<!-- Thêm sản phẩm -->         
<?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(isset($_POST['themsanpham'])){
                        try{
                            $ten = $_POST['name'];
                            $loaidt = $_POST['loaidt'];
                            $soluong = $_POST['quantity'];
                            // $hinhanh = $_FILES['image']['name'];
                            
                                $file = $_FILES["image"];
                                $filename = $file["name"];
                                $upload_dir = "anh/";
                                $file_tmp = $file["tmp_name"];
                                move_uploaded_file($file_tmp, $filename);

                                // lưu đường dẫn vào db                            
                                $savePathImg = $filename;

                            $giasanpham = $_POST['price'];
                            $motasanpham = $_POST['describe'];
                            $khophanloai = $_POST['warehouse'];
                            $loaihang = $_POST['cate'];

                            // insert into table sanpham
                            $sql_inSanpham = "INSERT INTO `sanpham`(ten_sanpham, gia_sanpham, anh, mota_sanpham, ID_khohang, ID_loaihang)
                                                VALUES(?, ?, ?, ?, ?, ?)"; 
                            $stmtSanpham = $conn->prepare($sql_inSanpham);
                            $stmtSanpham->execute([$ten, $giasanpham, $savePathImg, $motasanpham, $khophanloai, $loaihang]);
                             
                            // get id new table sanphams
                            $IDnewSanpham = $conn->lastInsertId();
                          
                            // insert into table dactrungsanpham
                            $sql_inDactrungsanpham = "INSERT INTO `dactrungsanpham`(soluong, ID_sanpham, ID_CTDTSP)
                                                        VALUES(?, ?, ?)";
                            $stmtDactrungsanpham = $conn->prepare($sql_inDactrungsanpham);  
                            $stmtDactrungsanpham->execute([$soluong, $IDnewSanpham, $loaidt]); 

                        }catch(PDOException $ex){
                            echo "Error: ".$ex->getMessage();
                        }
                    }
                }
            
            ?>  