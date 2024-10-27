<?php
class Calculator
{
    private $a;
    private $b;

    public function __set($name, $value) {
            $this->$name = $value;
    }

    public function __get($name) {
            return $this->$name;
        }

    public function add() {
        return $this->a + $this->b;
    }

    public function subtract() {
        return $this->a - $this->b;
    }

    public function multiply() {
        return $this->a * $this->b;
    }

    public function divide() {
        if ($this->b == 0) {
            throw new Exception("Division by zero");
        }
        return $this->a / $this->b;
    }
}
$calculator = new Calculator();

$calculator->a = 22;
$calculator->b = 5;

echo "加: ". $calculator->add(). "<br>";
echo "减: ". $calculator->subtract(). "<br>";
echo "乘: ". $calculator->multiply(). "<br>";
echo "除: ". $calculator->divide(). "<br>";