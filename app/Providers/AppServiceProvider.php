<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
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
        view()->composer('user.header', function ($view) {
            $user = auth()->user();
            $count = 0;
            if($user){
                $count = Cart::where('email', $user->email)->count();
                
            }
            $view->with('cartCount', $count);
            
        });
        Paginator::useBootstrap();
    }
}
