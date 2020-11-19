<?php
error_reporting(E_ALL);
$baseDir = __DIR__;

$scan = scandir(__DIR__);
$filter = array_filter($scan, function ($value) {
        return $value[0] !== '.' && strpos($value,'docker') === false;
});
$printHtml = '';
/**
 * @param array $filt
 * @param string $curDir
 * @param string $rout
 * @return string
 */

function dirRun(array $filt, string $curDir = '', string $rout = __DIR__) : string
{
    foreach ($filt as $dir) {
        $rout .= '/' . $dir;
        $webRout = substr($rout, 9);
        if(is_dir($rout)){
            $nestedDir = scandir($rout);
            $filterNestedDir = array_filter($nestedDir, static function ($value){
                return $value[0] !== '.';
            });
            $curDir = dirRun($filterNestedDir, $curDir, $rout);
            $rout = dirname($rout);
        } else {
            $rout = dirname($rout);
            $curDir .= "<li><a href='{$webRout}'>{$webRout}</a></li><br>";
        }
    }
    return $curDir;
}

$printHtml = dirRun($filter);



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <?= $printHtml ?>
    </ul>
</body>
</html>
