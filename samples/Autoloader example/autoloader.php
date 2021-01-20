<?php
spl_autoload_register(static function(string $class){
    $file = __DIR__ . 'index.php/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if(!file_exists($file)){
        exit("File {$file} can`t be loaded");
    }
    require_once $file;
});