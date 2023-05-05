<?php

use App\Http\Controllers\Backend\StationController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

    Route::get('/station', function () {
        return view('backend.station.indexmain');
    })->name('station.indexmain')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'));
        });

    // Index
    Route::get('station', [StationController::class, 'index'])
        ->name('station.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'));
        });

    // Create
    Route::get('station/create', [StationController::class, 'create'])
        ->name('station.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('station', [StationController::class, 'store'])
        ->name('station.store');

    // Show
    Route::get('station/{station}', [StationController::class, 'show'])
        ->name('station.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('station/edit/{station}', [StationController::class, 'edit'])
        ->name('station.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'))
                ->push(__('Edit'));
        });

    // Update
    Route::put('station/{station}', [StationController::class, 'update'])
        ->name('station.update');

    // Delete
    Route::get('station/delete/{station}', [StationController::class, 'delete'])
        ->name('station.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Station'), route('admin.station.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('station/{station}', [StationController::class, 'destroy'])
        ->name('station.destroy');

});
