<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
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

        View::share('unreadCount', $this->getUnreadNotificationCount());

        Schema::defaultStringLength(191);
    }

    /**
     * Run the Laravel scheduler every minute.
     */
    protected function runScheduledTasks()
    {
        Artisan::call('schedule:run');
    }

    private function getUnreadNotificationCount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $unreadNotifications = $user->unreadNotifications;
            return $unreadNotifications->count();
        }

        return 0; // Return 0 if no user is authenticated
    }
}
