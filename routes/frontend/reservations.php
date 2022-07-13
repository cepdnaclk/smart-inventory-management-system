<?php

use App\Models\Stations;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\CalendarController;
use App\Http\Controllers\frontend\ReservationController;

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
    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index') 
            ->push(__('Reservations'));
        });


    // Show
    Route::get('/reservation/{reservation}', [ReservationController::class, 'show'])->name('reservation.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
            ->push(__('Reservations'), route('frontend.reservation.index'))
            ->push(__('Show'));
        });
        

    // Edit 
    Route::get('/reservation/edit/{reservation}', [ReservationController::class , 'edit'])->name('reservation.edit')
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

    // Destroy
    Route::delete('reservation/destroy/{reservation}', [ReservationController::class, 'destroy'])
        ->name('reservation.destroy');

    Route::post('reservations', [CalendarController::class, 'store'])->name('calendar.store');
    Route::patch('reservations/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('reservations/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

});