<?php

use App\Models\Stations;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\CalendarController;
use App\Http\Controllers\frontend\ReservationController;

Route::get('/stations/{station}/reservations/', [CalendarController::class, 'index'])
    ->name('calendar.index')
    ->breadcrumbs(function (Trail $trail, Stations $station) {
        $trail->parent('frontend.index')
            ->push(__('Stations'), route('frontend.stations.index'))
            ->push($station->stationName, route('frontend.stations.station', $station))
            ->push(__('Reservations'));
    });

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::get('/reservation/{reservation}', [ReservationController::class, 'show'])->name('reservation.show');
Route::get('/reservation/edit/{reservation}', [ReservationController::class , 'edit'])->name('reservation.edit');
// Update
Route::put('reservation/update/{reservation}', [ReservationController::class, 'update'])
->name('reservation.update');


Route::post('reservations', [CalendarController::class, 'store'])->name('calendar.store');
Route::patch('reservations/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('reservations/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

