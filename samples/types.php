<?php
$int = 1;
$float = 1.0;
$string = '1';
$bool = true;
$array = [1];
$object = new stdClass();
$null = null;
$resource = fopen(__DIR__ . '/basics.php', 'rb');
fclose($resource);
$callable = static function () {
    return 1;
};
var_dump((bool)$int);
