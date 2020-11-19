<?php
$actualInsideRout = trim($_GET['rout'] ?? null, " \t\n\r\0\x0B/");
if(!$actualInsideRout){
    exit('Rout is required');
}
$config = require __DIR__ . '/config.php';
$baseDir = rtrim($config['baseDir'], '/');
$actualRout = $baseDir . '/' . $actualInsideRout;

if(!file_exists($actualRout)){
    exit('File does not exists');
}

$mimeType = mime_content_type($actualRout);
$fileSize = filesize($actualRout);
$baseName = basename($actualRout);

header("Content-Type: {$mimeType}");
header("Content-Disposition: attachment; filename={$baseName}");
header("Content-Length: {$fileSize}");
header('Pragma: no-cache');
readfile($actualRout);
exit();