<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withSchedule(function (Schedule $schedule): void {
            $schedule->command('prices:update')->everyFiveMinutes();
        })
        ->withMiddleware(function (Middleware $middleware): void {
            $middleware->alias([
                'admin' => \App\Http\Middleware\AdminMiddleware::class,
            ]);

            $middleware->append(\App\Http\Middleware\MaintenanceModeMiddleware::class);

            $middleware->validateCsrfTokens(except: [
                'logout',
                'admin/logout',
            ]);
        })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// On Vercel, storage is read-only — redirect to /tmp BEFORE service providers boot
$storagePath = $_ENV['APP_STORAGE_PATH'] ?? getenv('APP_STORAGE_PATH') ?? null;
if ($storagePath) {
    $app->useStoragePath($storagePath);
    $app->instance('path.storage', $storagePath);
}

return $app;
