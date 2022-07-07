<?php

use App\Http\Controllers\Api\OrderController;
Route::group(['prefix'=>'admin', 'middleware' => ['auth:sanctum','role:'.config('boilerplate.access.role.admin')]], function () {

    // get order details
    Route::get('order', [OrderController::class, 'index']);

    // show an order
    Route::get('order/{orderId}', [OrderController::class, 'show']);

    // update an order
    Route::put('order/{orderId}', [OrderController::class, 'update']);

    // delete an order
    Route::delete('order/{orderId}', [OrderController::class, 'destroy']);
});


