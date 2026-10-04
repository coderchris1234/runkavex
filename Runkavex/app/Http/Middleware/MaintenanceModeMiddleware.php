<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceModeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->maintenanceEnabled()) {
            return $next($request);
        }

        if ($this->shouldBypass($request)) {
            return $next($request);
        }

        return response()->view('errors.503', [], 503);
    }

    protected function maintenanceEnabled(): bool
    {
        try {
            return (bool) Cache::remember('settings.maintenance_mode', 60, function () {
                return DB::table('settings')->where('key', 'maintenance_mode')->value('value');
            });
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function shouldBypass(Request $request): bool
    {
        $path = '/'.trim($request->path(), '/');

        return str_starts_with($path, '/admin')
            || $path === '/login'
            || $path === '/logout'
            || $path === '/forgot-password'
            || str_starts_with($path, '/reset-password')
            || $path === '/up';
    }
}