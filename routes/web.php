<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\wishlistController;
use Symfony\Component\Routing\Route as RoutingRoute;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{product:slug}', [HomeController::class, 'veiwProduct'])->name('frontend.product.veiw');
Route::get('/shop', [shopController::class, 'shop'])->name('fronted.shop');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('frontend.addToCart')->middleware('customer');

//* Customer Auth
Route::get('/sign-in', [CustomerAuthController::class, 'ShowLoginForm'])->name('frontend.customer.login');
Route::post('/sign-in', [CustomerAuthController::class, 'login'])->name('frontend.customer.login.confirm');
Route::get('/sign-up', [CustomerAuthController::class, 'ShowRegisterForm'])->name('frontend.customer.register');
Route::post('/sign-up', [CustomerAuthController::class, 'register'])->name('frontend.customer.register.confirm');
Route::get('/my-profile', [CustomerAuthController::class, 'myProfile'])->name('frontend.customer.profile')->middleware('customer');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('frontend.customer.logout');


// *checkout Route
Route::get('/chechout', [CartController::class, 'checkout'])->name('frontend.checkout');

//*404 Route
Route::get('/notFound', [HomeController::class, 'notFound'])->name('frontend.404');

//*wishlists route
Route::middleware(['customer'])->group(function () {
    Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('frontend.addToWishlist');
    Route::post('/remove-from-wishlist', [WishlistController::class, 'removeFromWishlist'])->name('frontend.removeFromWishlist');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('frontend.wishlist');
});
