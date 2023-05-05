<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\OrderCompController;
use App\Http\Controllers\Frontend\User\CartController;
// use App\Http\Controllers\Frontend\User\UserController;
use App\Http\Controllers\Frontend\User\OrderController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Models\Cart;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */

Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('account/overview', [DashboardController::class, 'index'])
        ->middleware('is_user')
        ->name('overview')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'))
                ->push(__('Overview'), route('frontend.user.overview'));
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
    Route::get('my-order', [UserController::class, 'index'])->name('placbe.order');
});
