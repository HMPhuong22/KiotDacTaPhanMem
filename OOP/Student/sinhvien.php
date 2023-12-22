<?php
    class Student{
        public $ID, $ten, $gioitinh, $diachi;

        public function __construct($ID, $ten, $gioitinh, $diachi){
            $this->ID=$ID;
            $this->ten=$ten;
            $this->gioitinh=$gioitinh;
            $this->diachi=$diachi;
        }

        public function setID(){
            $this->ID=$ID;
        }
        public function getID(){
            return $this->ID;
        }

        public function setName($ten){
            $this->ten=$ten;
        }
        public function getName(){
            return $this->ten;
        }

        public function setGioitinh(){
            $this->gioitinh=$gioitinh;
        }
        public function getGioitinh(){
            return $this->gioitinh;
        }

        public function setDiachi(){
            $this->diachi=$diachi;
        }
        public function getDiachi(){
            return $this->diachi;
        }

        public function show(){
            echo 'ID: '.$this->ID.' Name: '.$this->ten.' Gioi tinh: '.$this->gioitinh.' Dia chi: '.$this->diachi;
        }
    }

    // $f = new Student('11', 'phuong', 'nam', 'hoa binh');
    // $f->show();