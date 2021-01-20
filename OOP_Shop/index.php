<?php
declare(strict_types = 1);
error_reporting(E_ALL);

use app\components\App;

require_once __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/configs/web.php';

App::init($config);
