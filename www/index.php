<?php

// error_reporting(0);

use App\Http\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/config/bootstrap.php';
require_once __DIR__ . '/src/routes/api.php';
require_once __DIR__ . '/src/config/cors.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$factories      = require_once __DIR__ . '/src/config/factories.php';
$middlewares    = require_once __DIR__ . '/src/config/middlewares.php';
$databaseConfig = require_once __DIR__ . '/src/config/database.php';

/**
 * Allow CORS
 */
allowCors();

/**
 * Set the exception handler
 */
set_exception_handler([App\Exceptions\HandleExceptions::class, 'handle']);

/**
 * Dispatch the routes
 */
dispatch(Router::getRoutes(), $factories, $middlewares, $databaseConfig);
