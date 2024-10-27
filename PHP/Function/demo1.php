<?php
function shop(){
    global $cPrice, $pPrice, $prPrice, $cCount, $pCount, $prCount;
    return ($cCount * $cPrice) + ($pCount * $pPrice) + ($prCount * $prPrice);
}
$cPrice = 4999;
$pPrice = 788;
$prPrice = 2999;

$cCount = 5;
$pCount = 10;
$prCount = 1;

$totalPrice = shop();
echo "购物车中商品的总价为：".$totalPrice;