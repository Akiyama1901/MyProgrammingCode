<?php
$books = array(
    array("name" => "平凡的世界", "price" => 30, "count" => 1, "amount" => 30),
    array("name" => "活着", "price" => 25, "count" => 1, "amount" => 25),
    array("name" => "生死疲劳", "price" => 34.9, "count" => 2, "amount" => 69.8),
    array("name" => "PHP程序设计", "price" => 45, "count" => 2, "amount" => 90),
    array("name" => "一只特立独行的猪", "price" => 40, "count" => 3, "amount" => 120)
);

array_multisort(array_column($books, 'amount'), SORT_ASC, $books);

foreach ($books as $book) {
    echo $book['name'] . ' - ' . $book['amount'] . '<br>';
}

echo "<br>";

$money = 0;
foreach ($books as $book){
    $money+=$book['amount'];
}
echo "总金额: {$money}<br>";