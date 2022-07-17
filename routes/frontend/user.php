<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\OrderCompController;
use App\Http\Controllers\Frontend\User\CartController;
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

  
   
    Route::put('orders/{order}', [OrderController::class, 'change_status'])->name('orders.change.staus')
    ;

    Route::get('show-my-order',[OrderController::class, 'index'])->name('orders.index')  ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('My Orders'), route('frontend.user.account'));
    });
// Show
Route::get('orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.user.dashboard'))
            ->push(__('My Orders'),route('frontend.user.orders.index'))
            ->push(__('Show'));
});
Route::post('store-request', [OrderController::class, 'store'])->name('store.request');

    Route::get("users/{componentItem}/ordercomp",[OrderCompController::class,'orderComponent'])->name('ordercomp');
    
//Mail
Route::post('order/mail', [OrderController::class, 'mail'])
->name('order.mail');
    
});



