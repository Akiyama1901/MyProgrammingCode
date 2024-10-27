<?php
$total = rand(0, 2000);

function fun($total)
{
    if ($total >= 1000)
        return $total * 0.85;
    elseif ($total >= 500)
        return $total * 0.9;
    elseif ($total >= 100)
        return $total * 0.95;
    else
        return $total;
}

$afterprice = fun($total);
echo "您本次的购物的总价为：".$total."元。"."<br>"."您本次实付的金额为：". $afterprice."元。";
