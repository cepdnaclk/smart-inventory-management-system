<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\User\CartController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('products', [CartController::class, 'index'])->name('products');
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');  
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::post('place-order', [CartController::class, 'placeOrder'])->name('place.order');

  
    Route::get('show-my-order',[CartController::class,'showMyOrders'])->name('show.order')  ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('My Order'), route('frontend.user.account'));
    });

             
    
});
