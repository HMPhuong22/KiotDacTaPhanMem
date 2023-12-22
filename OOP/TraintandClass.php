<?php
    trait Hello{
        public function sayHello(){
            echo 'Hello';
        }
    }

    trait World{
        public function sayWorld(){
            echo ' World';
        }
    }

    class say{
        use Hello, World;
        public function sayHelloWorld(){
            echo '!';
        }
    }

    $dt = new say();
    $dt->sayHello();
    $dt->sayWorld();
    $dt->sayHelloWorld();

