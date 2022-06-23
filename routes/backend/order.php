<?php

use App\Http\Controllers\Backend\OrderController;
use App\Models\Order;
use Tabuna\Breadcrumbs\Trail;


// Lecturer Order request  Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Lecturer'])->group(function () {




 // index
 Route::get('/orders/lecturer', [OrderController::class, 'lecturer_index'])
 ->name('orders.lecturer.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

 // Show
 Route::get('/orders/lecturer/{order}/view/', [OrderController::class, 'lecturer_show'])
 ->name('orders.lecturer.show')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'), route('admin.orders.lecturer.index'))
         ->push(__('Show'));
 });

});
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



    // Lecturer  Routes ----------------------------------------------------------------------------


  
   

