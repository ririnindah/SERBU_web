<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Koin;
use App\Models\SerbuUser;
use App\Models\User;
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
        View::composer('partials.header', function ($view) {

            $userCoin = 0;

            if (session()->has('user.outlet_id')) {
                $userCoin = \App\Models\Koin::where(
                    'outlet_id',
                    session('user.outlet_id')
                )->sum('koin');
            }

            $view->with('userCoin', $userCoin);
        });
    }

}
