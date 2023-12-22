<?php
    class Person{
        public $name, $age;

        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }

        public function introduce(){
            echo "My name is ".$this->name." and I am".$this->age. " years old";
        }
    }

    class Student extends Person{
        private $studentID;

        public function __construct($studentID, $name, $age){
            $this->studentID = $studentID;
            Person::__construct($name, $age);
        }

        public function study(){
            echo 'ID student: '.$this->studentID."</br>Name: ".$this->name."</br>Age: ".$this->age."</br>Studing...";
        }
    }
    echo '<h1>Infomation Student</h1>';
    // $person1 = new Person(' Ha Minh Phuong', ' 21'); 
    // $person1->introduce();
    $student1 = new Student('201200280', 'Ha Minh Phuong', '21');
    $student1->study();
?>