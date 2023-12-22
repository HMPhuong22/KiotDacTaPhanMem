<?php  
    class Product{
        private $name, $price, $decripttion;

        public function __construct($name, $price, $decription){
            $this->name = $name;
            $this->price = $price;
            $this->decription = $decription;
        }

        public function setName($name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }

        public function setPrice($price){
            $this->price = $price;
        }
        public function getPrice() {
            return $this->price;
        }

        public function setDecription($decripttion){
            $this->decription = $decription;
        }
        public function getDecription(){
            return $this->decription;
        }

        public function showProduct(){
            echo 'Ten san pham: '.$this->name.'</br>Gia: '.$this->price.'</br>Mo ta san pham: '.$this->decription;
        }
    }

    $pro1 = new Product(' Ca chua', 1200.00, ' Moi');
    $pro1->showProduct();

    // Thay đổi giá sản phẩm
    echo '<hr>';
    $pro1->setName('Candy');
    $pro1->setPrice(10.000);
    $pro1->showProduct();
    // echo $pro1.getName();
?>  