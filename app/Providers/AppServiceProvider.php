<?php

namespace App\Providers;

use App\Models\Cart;
use view;
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
        view()->composer('*', function ($view) {
            $cart = Cart::with('product')->where('customer_id', auth('customer')?->user()->id ?? 0)->get();

            $view->with('carts', [
                'count' => count($cart),
                'data'  => $cart,
            ]);
        });


        Paginator::useBootstrap();
    }
}
