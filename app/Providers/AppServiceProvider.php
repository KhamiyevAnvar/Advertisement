<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        // --------------------------

        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $notifications = Notification::query()
                    ->where('user_id', Auth::user()->id)
                    ->get();

                $view->with("notifications", $notifications);
            }
        });
    }
}
