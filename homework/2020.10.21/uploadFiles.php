<?php
$config = require __DIR__ . '/config.php';
$baseDir = $config['baseDir'];

$file =  !in_array(0,$_FILES['file']['size']) ? reArrayFiles($_FILES['file']) : null;
$actualInsideRout = $_POST['actualInsideRout'];

if(!$file) {
    exit("Files was not upload... Files are empty or have errors");
}

$actualDir = rtrim($baseDir, '/') . '/' . ltrim($actualInsideRout, '/');

foreach($file as $fl) {
    $actualRout = rtrim($actualDir, '/') . '/' . ltrim($fl['name'], '/');
    move_uploaded_file($fl['tmp_name'], $actualRout);
}

header("Location: index.php?rout={$actualInsideRout}");
exit();

/**
 * @param array $filePost
 * @return array
 */

function reArrayFiles(array $filePost)  : array {
    $fileArray = [];
    $fileCount = count($filePost['name']);
    $fileKeys = array_keys($filePost);

    for ($i=0; $i<$fileCount; $i++) {
        foreach ($fileKeys as $key) {
            $fileArray[$i][$key] = $filePost[$key][$i];
        }
    }

    return $fileArray;
}