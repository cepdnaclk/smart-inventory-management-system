<?php

use App\Models\Stations;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\CalendarController;

Route::get('/stations/{station}/reservations/', [CalendarController::class, 'index'])
    ->name('calendar.index')
    ->breadcrumbs(function (Trail $trail, Stations $station) {
        $trail->parent('frontend.index')
            ->push(__('Stations'), route('frontend.stations.index'))
            ->push($station->stationName, route('frontend.stations.station', $station))
            ->push(__('Reservations'));
    });

// Route::post('reservations', [CalendarController::class, 'store'])->name('calendar.store');
// Route::patch('reservations/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
// Route::delete('reservations/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');



// TODO: Move into /api/ routes
Route::group(['prefix' => 'reservations'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/{station}/', [CalendarController::class, 'list'])->name('calendar.list');
        Route::post('/', [CalendarController::class, 'store'])->name('calendar.store');
        Route::patch('/{id}', [CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    });
});