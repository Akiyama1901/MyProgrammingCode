<?php
function cat(){
    return "nekoMeowMeow";
}
function dog(){
    return "旺财WangWang";
}
function sounds($animal)
{
    if ($animal === 'cat')
        echo cat();
    elseif ($animal === 'dog')
        echo dog();
}

sounds('dog');
echo "<br>";
//sounds('cat');