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

            $customerId = auth('customer')->user()->id ?? 0;

            // CART
            $cart = Cart::with('product')
                ->where('customer_id', $customerId)
                ->get();

            $view->with('carts', [
                'count' => $cart->count(),
                'data'  => $cart,
            ]);

            // WISHLIST (default count = 0)
            $wishlist = \App\Models\Wishlist::with('product')
                ->where('customer_id', $customerId)
                ->get();

            $view->with('wishlists', [
                'count' => $wishlist->count(), // login না থাকলে 0
                'data'  => $wishlist,
            ]);
        });

        Paginator::useBootstrap();
    }
}
