<?php

use App\Models\Stations;

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Frontend\StationController;


Route::prefix('stations')->group(function () {

    Route::get('/', [StationController::class, 'index'])
        ->name('stations.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Stations'), route('frontend.stations.index'));
        });

    Route::get('/{station}', [StationController::class, 'viewStation'])
        ->name('stations.station')
        ->breadcrumbs(function (Trail $trail, $station) {
            $stations = Stations::find($station);
            Session::put('station', $stations);
            $trail->parent('frontend.index')
                ->push(__('Stations'), route('frontend.stations.index'))
                ->push($stations->stationName, route('frontend.stations.station', $stations->stationName));
        });
 
});


