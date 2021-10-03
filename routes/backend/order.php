<?php

use App\Http\Controllers\Backend\OrderController;
use Tabuna\Breadcrumbs\Trail;



Route::get('/orders', [OrderController::class, 'index'])
->name('orders.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Orders'), route('admin.orders.index'));
});

// Create
Route::get('orders/create', [OrderController::class, 'create'])
    ->name('orders.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Create'));
    });


// Store
Route::post('orders', [OrderController::class, 'store'])
    ->name('orders.store');

// Show
Route::get('orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Show'));
});

// Edit
Route::get('orders/edit/{order}', [OrderController::class, 'edit'])
    ->name('orders.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Edit'));
});


// Update
Route::put('orders/{order}', [OrderController::class, 'update'])
->name('orders.update');

// Delete
Route::get('orders/delete/{order}', [OrderController::class, 'delete'])
    ->name('orders.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Delete'));
});

// Destroy
Route::delete('orders/{order}', [OrderController::class, 'destroy'])
    ->name('orders.destroy');


