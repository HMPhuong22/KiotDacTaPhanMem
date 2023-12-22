<?php
    class Calculator {
        private $result;

        public function __construct() {
            $this->result = 0;
        }

        public function add($number) {
            $this->result += $number;
        }

        public function subtract($number) {
            $this->result -= $number;
        }

        public function multiply($number) {
            $this->result *= $number;
        }

        public function divide($number) {
            if ($number != 0) {
                $this->result /= $number;
            } else {
                echo "Lỗi: Không thể chia cho 0.";
            }
        }

        public function getResult() {
            return $this->result;
        }
    }

    // Sử dụng lớp Calculator
    $calculator = new Calculator();

    $calculator->add(6);
    $calculator->subtract(2);
    $calculator->multiply(3);
    $calculator->divide(23);

    echo "Kết quả: " . $calculator->getResult();

?>