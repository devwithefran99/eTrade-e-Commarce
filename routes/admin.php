<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::controller(CategoryController::class)
        ->prefix('/categories')
        ->name('category.')
        ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{category}', 'delete')->name('delete');
            Route::get('/edit/{category}', 'edit')->name('edit');
            Route::post('/update/{category}', 'update')->name('update');
        });

    Route::controller(ProductController::class)
        ->prefix('/products')
        ->name('products.')
        ->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
});
