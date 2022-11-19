<?php

use App\Http\Controllers\Backend\LocationsController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

//    Index
    Route::get('/locations', [LocationsController::class,'index'])
    ->name('locations.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Locations'), route('admin.locations.index'));
        });

//    Create
    Route::get('/locations/create', [LocationsController::class,'create'])
    ->name('locations.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Locations'), route('admin.locations.index'))
                ->push(__('Create'), route('admin.locations.create'));
        });

//    Store
    Route::post("/locations/store", [LocationsController::class,'store'])
        ->name('locations.store');

//    Edit
    Route::get('/locations/{location}/edit', [LocationsController::class,'edit'])
    ->name('locations.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Locations'), route('admin.locations.index'))
                ->push(__('Edit'));
        });

//    Update
    Route::post('/locations/{location}/update', [LocationsController::class,'update'])
        ->name('locations.update');

//    Delete
    Route::get('/locations/{location}/delete', [LocationsController::class,'delete'])
        ->name('locations.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Locations'), route('admin.locations.index'))
                ->push(__('Delete'));
        });

//    Destroy
    Route::delete('/locations/{location}/destroy', [LocationsController::class,'destroy'])
        ->name('locations.destroy');

});