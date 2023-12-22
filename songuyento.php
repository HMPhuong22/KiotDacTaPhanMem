<?php
    function KtraSoNguyenTo($n){
        if($n <= 1){
            return false;
        }
        elseif($n == 2){
            return true;
        }
        else{
            for($i = 2; $i <= sqrt($n); $i++){
                if($n % $i == 0){
                    return false;
                }
                elseif($n % 2 == 0){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
    }