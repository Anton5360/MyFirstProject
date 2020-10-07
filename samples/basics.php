<?php
/*$1re = 1;
$te*st-rest = 1;

$test1 = 0;
var_dump($test1);

$_test_2 = 2;
var_dump($_test_2);

$skillUpVariable = 'Hohoho';
var_dump($skillUpVariable);

$skillUpVariable = 'Lalala';
var_dump($skillUpVariable);

$school = $skillUpVariable;
var_dump($skillUpVariable);



$level01 = 'qwerty';
$$level01 = 123;
var_dump($qwerty);*/

$array = [];
//var_dump($array);
for($i=0;$i<10;$i++){
    $array[$i] = $i;
}
//var_dump($array);
echo max($array);
unset($array[0]);
var_dump($array);