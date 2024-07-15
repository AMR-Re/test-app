<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TodoService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TodoService::class, function ($app) {
            return new TodoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
