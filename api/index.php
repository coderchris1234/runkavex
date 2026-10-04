<?php

/**
 * Vercel serverless entry point for Laravel.
 * This file lives at the repo root /api/index.php.
 * The Laravel app is in the /Runkavex subdirectory.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__) . '/Runkavex';

// Maintenance mode check
if (file_exists($maintenance = $root . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require $root . '/vendor/autoload.php';

// Boot Laravel and handle the incoming request
/** @var Application $app */
$app = require_once $root . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
