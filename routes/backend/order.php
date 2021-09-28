<?php

use App\Http\Controllers\Backend\OrderController;
use Tabuna\Breadcrumbs\Trail;



Route::get('/orders', [OrderController::class, 'index'])
->name('order.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Orders'), route('admin.order.index'));
});
