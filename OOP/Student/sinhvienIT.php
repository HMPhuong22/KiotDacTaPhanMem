<?php
    require_once("sinhvien.php");
    class StudentIT extends Student{
        public $php, $java;

        public function __construct($ID, $ten, $gioitinh, $diachi, $php, $java){
            parent::__construct($ID, $ten, $gioitinh, $diachi);
            $this->php=$php;
            $this->java=$java;
        }

        public function setPHP(){
            $this->php=$php;
        }
        public function getPHP(){
            return $this->php;
        }

        public function setJava(){
            $this->java=$java;
        }
        public function getJava(){
            return $this->java;
        }

        public function DiemTB(){
            return ($this->getPHP()+$this->getJava())/2;
        }

        public function show(){
            parent::show();
            echo $this->DiemTB();
        }
    }

    // $dt = new StudentIT(12, 'phuong', 'nam', 'hoa binh', 10, 5);
    // $dt->show();