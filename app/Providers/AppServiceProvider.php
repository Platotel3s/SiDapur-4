<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
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
        view()->composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role === 'customer') {

                $keranjang = Keranjang::where('user_id', Auth::id())->first();
                $count = 0;

                if ($keranjang) {
                    $count = $keranjang->item()->sum('kuantitas');
                }

                $view->with('cartCount', $count);
            }
        });
        if (env('APP_ENV')==='production') {
            URL::forceScheme('https');
        }
    }
}
