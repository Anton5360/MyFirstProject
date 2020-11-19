<?php
error_reporting(E_ALL);
$config = require __DIR__ . '/config.php';
$baseDir = $config['baseDir'];
$actualInsideRout = $_POST['actualInsideRout'];
$deleteDir = $_POST['deleteDir'];

$rout = rtrim($actualInsideRout, '/') . '/' . ltrim($deleteDir, '/');

$pathToDelete = rtrim($baseDir, '/') . '/' . ltrim($rout, '/');


static $count;

if(is_file($pathToDelete)){
    unlink($pathToDelete);
    header("Location: index.php?rout={$actualInsideRout}");
    exit();
}

while($count !== 1) {
    $count = 0;
    DeleteDirectory($pathToDelete);
}

header("Location: index.php?rout={$actualInsideRout}");
exit();




function DeleteDirectory($dir) {
    global $count;
    $count ++;
//    if(is_file($dir)){
//        unlink($dir);
//        $dir = $dirname;
//    }

    if(dir_is_empty($dir)) {
        rmdir($dir);
    } else {
        $actualInsideRout = scandir($dir);
        for($i = 2; $i <= array_key_last($actualInsideRout); $i++){
            DeleteDirectory($dir . '/' . $actualInsideRout[$i]);
        }
    }
}

function dir_is_empty($dir) {
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            closedir($handle);
            return FALSE;
        }
    }
    closedir($handle);
    return TRUE;
}
