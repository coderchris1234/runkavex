<?php

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

// Vercel's filesystem is read-only except for /tmp.
// Point Laravel's storage and cache to /tmp so it can write.
$_ENV['APP_STORAGE'] = '/tmp/storage';

// Create required writable directories in /tmp
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
