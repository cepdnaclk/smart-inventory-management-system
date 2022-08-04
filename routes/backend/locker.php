<?php

use App\Http\Controllers\Backend\ComponentItemController;
use App\Http\Controllers\Backend\LockerController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['role:Administrator|Technical Officer'])->group(function () {

    Route::get('/locker', function () {
        return view('backend.locker.index');
    })->name('locker.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'));
        });


    //locker details --------------------------------------------------------------------

    //Index
    Route::get('locker/details', [LockerController::class, 'index'])
        ->name('locker.details.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'))
                ->push(__('details'));
        });

    // Create
    Route::get('locker/details/create', [LockerController::class, 'create'])
        ->name('locker.details.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'))
                ->push(__('details'), route('admin.locker.details.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('locker/details', [LockerController::class, 'store'])
        ->name('locker.details.store');

    // Show
    Route::get('locker/details/{lockerDetail}', [LockerController::class, 'show'])
        ->name('locker.details.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'))
                ->push(__('details'), route('admin.locker.details.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('locker/details/edit/{lockerDetail}', [LockerController::class, 'edit'])
        ->name('locker.details.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'))
                ->push(__('details'), route('admin.locker.details.index'))
                ->push(__('Edit'));
        });


    // Update
    Route::put('locker/details/{lockerDetail}', [LockerController::class, 'update'])
        ->name('locker.details.update');

    // Delete
    Route::get('locker/details/delete/{lockerDetail}', [LockerController::class, 'delete'])
        ->name('locker.details.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Lockers'), route('admin.locker.index'))
                ->push(__('details'), route('admin.locker.details.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('locker/details/{lockerDetail}', [LockerController::class, 'destroy'])
        ->name('locker.details.destroy');
});