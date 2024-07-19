<?php

use App\Http\Controllers\Backend\MachinesController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

    // Index
    Route::get('machines', [MachinesController::class, 'index'])
        ->name('machines.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'));
        });

    // Create
    Route::get('machines/create', [MachinesController::class, 'create'])
        ->name('machines.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'), route('admin.machines.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('machines', [MachinesController::class, 'store'])
        ->name('machines.store');

    // Show
    Route::get('machines/{machines}', [MachinesController::class, 'show'])
        ->name('machines.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'), route('admin.machines.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('machines/edit/{machines}', [MachinesController::class, 'edit'])
        ->name('machines.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'), route('admin.machines.index'))
                ->push(__('Edit'));
        });

    // Edit locations
    Route::get('machines/edit/{machines}/locations', [MachinesController::class, 'editLocations'])
        ->name('machines.edit.location')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'), route('admin.machines.index'))
                ->push(__('Edit Locations'));
        });

    // Update
    Route::put('machines/{machines}', [MachinesController::class, 'update'])
        ->name('machines.update');

    // Delete
    Route::get('machines/delete/{machines}', [MachinesController::class, 'delete'])
        ->name('machines.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Machines'), route('admin.machines.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('machines/{machines}', [MachinesController::class, 'destroy'])
        ->name('machines.destroy');

});