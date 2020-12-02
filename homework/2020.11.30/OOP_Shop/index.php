<?php
spl_autoload_register(static function(string $class){
    $file = __DIR__ . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if(!file_exists($file)){
        exit("File {$file} can`t be loaded");
    }
    require_once $file;
});

$testController = new \components\Dispatcher($_SERVER['REQUEST_URI']);
