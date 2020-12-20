<?php

require_once __DIR__ . '/vendor/autoload.php';

$testController = new \components\Dispatcher($_SERVER['REQUEST_URI']);
