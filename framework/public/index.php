<?php

define('BASE_PATH', dirname(dirname(__DIR__)));
require_once BASE_PATH . '/vendor/autoload.php';

// require_once __DIR__ . '/../../vendor/autoload.php';

use Framework\Http\{Request, Kernel};

$request = Request::create();

$kernel = new Kernel;
$kernel->handle($request)->send();