<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });

        Paginator::useBootstrap();

        if ($this->app->runningInConsole()) {
            $this->runScheduledTasks();
        }
    }

    /**
     * Run the Laravel scheduler every minute.
     */
    protected function runScheduledTasks()
    {
        Artisan::call('schedule:run');
    }
}
