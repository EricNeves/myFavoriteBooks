<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/config/bootstrap.php';
require_once __DIR__ . '/src/routes/api.php';

$factories   = require_once __DIR__ . '/src/config/factories.php';
$middlewares = require_once __DIR__ . '/src/config/middlewares.php';

dispatch(\App\Http\Router::getRoutes(), $factories, $middlewares);
