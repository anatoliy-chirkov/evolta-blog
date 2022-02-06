<?php

namespace App\Providers;

use App\Adapters\ActivityJsonRpcAdapter;
use App\Contracts\Activity\ActivityLogger;
use App\Contracts\Activity\ActivityStorage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ActivityLogger::class, ActivityJsonRpcAdapter::class);
        $this->app->bind(ActivityStorage::class, ActivityJsonRpcAdapter::class);
    }
}
