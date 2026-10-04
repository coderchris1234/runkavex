<?php

/**
 * Vercel serverless entry point for Laravel.
 *
 * Vercel's PHP runtime invokes this file for every request routed to
 * api/index.php. We bootstrap Laravel from the project root (one level up)
 * so that all __DIR__-relative paths inside the framework resolve correctly.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__);

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
