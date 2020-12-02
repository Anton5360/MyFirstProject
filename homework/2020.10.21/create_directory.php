<?php
error_reporting(E_ALL);

require_once __DIR__ . '/security.php';

$config = require __DIR__ . '/config.php';
$baseDir = $config['baseDir'];
$actualInsideRout = $_POST['actualInsideRout'];
$name = $_POST['name'];

if (!$name) {
    exit('Name are required');
}
$rout = rtrim($actualInsideRout , '/') . '/' . trim($name, '/ \n\r\0\x0B');

$mkdir = $baseDir . '/' . $rout;

mkdir($mkdir);


header("Location: index.php?rout={$actualInsideRout}");
exit();