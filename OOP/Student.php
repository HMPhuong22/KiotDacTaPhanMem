<?php
    class Student{
        // thuoc tinh
        public $ID, $name, $gender;
        
        // ham tao
        public function __construct($ID, $name, $gender){
            $this->ID = $ID;
            $this->name = $name;
            $this->gender = $gender;
        }

        //ham thanh vien
        public function Show(){
            echo 'ID: '.$this->ID.' - Name: '.$this->name.' - Gender: '.$this->gender;
        }
    }
    $dt1 = new Student("123", "Phuong", "nam");
    $dt1->Show();
    // $sv2 = new Student();
    // $sv2->Show();
    