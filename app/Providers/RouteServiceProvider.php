<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

final class RouteServiceProvider extends ServiceProvider
{
    public const API_LIMIT = 60;


    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            $user = $request->user();
            $key = ($user instanceof User) ? (string) $user->id : $request->ip();
            assert(is_string($key));

            return Limit::perMinute(self::API_LIMIT)->by($key);
        });

        $this->routes(function (Filesystem $filesystem) {
            foreach ($filesystem->allFiles(base_path('routes/api')) as $file) {
                Route::middleware('api')->prefix('api')->group($file->getPathname());
            }

            foreach ($filesystem->allFiles(base_path('routes/web')) as $file) {
                Route::middleware('web')->group($file->getPathname());
            }
        });
    }
}
