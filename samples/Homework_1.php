<?php
error_reporting(E_ALL);
$number = (int)$_GET['p1'];
/////////// Home Work
//$x = ?
$x = true;
if ($x == 1) {
    echo 1;
}
if ($x == 2) {
    echo 2;
}
if ($x == 3) {
    echo 3;
}
// 123
echo '<br>';
// switch ($number) --> ugly ternary operators

/*switch ($number) {
    case 0:
    case $number < 0:
        echo 'Number is zero';
        break;
    case 1:
        echo 'Number is one';
        break;
    case 2:
        echo 'Number is two';
        break;
    case $number % 2 === 0:
        echo "Number {$number} is even";
        break;
    default:
        echo "Number {$number} is odd";
}*/

echo $number === 0 ?'Number is zero' : ($number < 0 ? 'Number is zero' : ($number === 1 ? 'Number is one' : ($number === 2 ? 'Number is two' : ($number % 2 === 0 ? "Number {$number} is even" : "Number {$number} is odd"))));