<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

use Framework\Http\{Request, Kernel};

$request = Request::create();

$kernel = new Kernel;
$kernel->handle($request)->send();