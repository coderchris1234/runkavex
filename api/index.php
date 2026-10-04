<?php

// Show ALL PHP errors directly — remove after debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/**
 * Vercel serverless entry point for Laravel.
 * This file lives at the repo root /api/index.php.
 * The Laravel app is in the /Runkavex subdirectory.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// __DIR__ = /var/task/api, so dirname(__DIR__) = /var/task
$root = dirname(__DIR__) . '/Runkavex';

// Sanity check — output $root so we can confirm the path
if (!is_dir($root)) {
    http_response_code(500);
    die('ERROR: Laravel root not found at: ' . $root . '<br>__DIR__ is: ' . __DIR__);
}

if (!file_exists($root . '/vendor/autoload.php')) {
    http_response_code(500);
    die('ERROR: vendor/autoload.php not found at: ' . $root . '/vendor/autoload.php');
}

if (!file_exists($root . '/bootstrap/app.php')) {
    http_response_code(500);
    die('ERROR: bootstrap/app.php not found at: ' . $root . '/bootstrap/app.php');
}

// Vercel filesystem is read-only except /tmp — redirect storage there
$dirs = [
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/storage/app',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

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
