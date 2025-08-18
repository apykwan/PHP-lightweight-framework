<?php

use Framework\Http\Request;

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();

dd($request);

echo "hello world";