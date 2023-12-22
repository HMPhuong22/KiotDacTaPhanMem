<?php
    function giaipt($a, $b, $c){
        $delta = "";
        $num = 2;

        $delta = $b*$b - 4*$a*$c;
        if($a == 0){
            $nghiembang1 = -$c/$b;
            echo "Nghiem cua phuong trinh la ".$nghiembang;        
        }
        if($a != 0){
            if($delta < 0){
                echo "Phuong trinh vo nghiem";
            }
            elseif($delta == 0){
                echo "Phuong trinh co nghiem kep la ".-$b/$num*$a;
            }
            else{
                $nghiemrb1 = -$b+sqrt($delta)/$num*$a;
                $nghiemrb2 = -$b-sqrt($delta)/$num*$a;
                echo 'Phuong trinh co 2 nghiem phan biet la '.$nghiemrb1.' va '.$nghiemrb2;
            }
        }
    }