<?php

use App\Models\Stations;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\CalendarController;
use App\Http\Controllers\Backend\ReservationController;

Route::middleware(['auth'])->group(function () {

    Route::get('/stations/{station}/reservations/', [CalendarController::class, 'index'])
        ->name('calendar.index')
        ->breadcrumbs(function (Trail $trail, Stations $station) {
            $trail->parent('frontend.index')
                ->push(__('Stations'), route('frontend.stations.index'))
                ->push($station->stationName, route('frontend.stations.station', $station))
                ->push(__('Reservations'));
        });

    //Index
    Route::get('/reservation', [ReservationController::class, 'index_user'])->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Reservations'));
            $trail->parent('frontend.index')
                ->push(__('Reservations'));
        });


    // Show
    Route::get('/reservation/{reservation}', [ReservationController::class, 'show_user'])->name('reservation.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Reservations'), route('frontend.reservation.index'))
                ->push(__('Show'));
        });



    // Edit 
    Route::get('/reservation/edit/{reservation}', [ReservationController::class, 'edit'])->name('reservation.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Reservations'), route('frontend.reservation.index'))
                ->push(__('Edit'));
        });
    // Update
    Route::put('reservation/update/{reservation}', [ReservationController::class, 'update'])
        ->name('reservation.update');

    // Delete
    Route::get('reservation/delete/{reservation}', [ReservationController::class, 'delete'])
        ->name('reservation.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Reservations'), route('frontend.reservation.index'))
                ->push(__('Delete'));
        });


    // API Routes
    // API Routes

    // TODO: Move into /api/ routes
    Route::group(['prefix' => 'reservations'], function () {
        Route::get('/{station}/', [CalendarController::class, 'list'])->name('calendar.list');
        Route::post('/', [CalendarController::class, 'store'])->name('calendar.store');
        Route::patch('/{id}', [CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    });
    // TODO: Move into /api/ routes
    Route::group(['prefix' => 'reservations'], function () {
        Route::get('/{station}/', [CalendarController::class, 'list'])->name('calendar.list');
        Route::post('/', [CalendarController::class, 'store'])->name('calendar.store');
        Route::patch('/{id}', [CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    });
});
