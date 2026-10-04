<?php

// Capture everything — errors, output, exceptions
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Override Vercel's error page by setting our own error handler
set_exception_handler(function ($e) {
    http_response_code(200); // Force 200 so Vercel doesn't intercept
    header('Content-Type: text/plain');
    echo "=== EXCEPTION ===\n";
    echo get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (line " . $e->getLine() . ")\n";
    echo "=== TRACE ===\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    http_response_code(200);
    header('Content-Type: text/plain');
    echo "=== PHP ERROR [$errno] ===\n";
    echo "$errstr\n";
    echo "File: $errfile (line $errline)\n";
    exit(1);
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        http_response_code(200);
        header('Content-Type: text/plain');
        echo "=== FATAL ERROR ===\n";
        echo $error['message'] . "\n";
        echo "File: " . $error['file'] . " (line " . $error['line'] . ")\n";
    }
});

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__) . '/Runkavex';

// Path checks
if (!is_dir($root)) {
    http_response_code(200);
    header('Content-Type: text/plain');
    die("ERROR: Laravel root not found at: $root\n__DIR__ = " . __DIR__);
}
if (!file_exists($root . '/vendor/autoload.php')) {
    http_response_code(200);
    header('Content-Type: text/plain');
    die("ERROR: vendor/autoload.php missing at $root/vendor/autoload.php");
}

// Create /tmp storage dirs
foreach ([
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/storage/app',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

if (file_exists($maintenance = $root . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $root . '/vendor/autoload.php';

/** @var Application $app */
$app = require_once $root . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
