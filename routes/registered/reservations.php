<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Registered\CalendarController;

/*
 * Registered users Access Controllers
 * All route names are prefixed with 'user'.
 * 
 */

Route::get('/stations/calendar/index', [CalendarController::class, 'index'])
    ->name('calendar.index')
    ->breadcrumbs(function (Trail $trail) {
        $stations = Session::get('station');
        //$stations = Stations::find($station);
        $trail->parent('frontend.index')
            ->push(__('Stations'), route('frontend.stations.index'))
            ->push($stations->stationName, route('frontend.stations.station',
                $stations->stationName));
    });

Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');

Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');