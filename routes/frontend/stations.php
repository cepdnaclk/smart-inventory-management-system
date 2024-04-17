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

    // Only logged in users can view the dashboard 
    Route::middleware(['auth'])->group(function () {

        Route::get('/list', [StationController::class, 'sidebarIndex'])
            ->name('stations.list')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('frontend.index')
                    ->push(__('Stations'), route('frontend.stations.list'));
            });

        Route::get('/list/{station}', [StationController::class, 'show'])
            ->name('station.show')
            ->breadcrumbs(function (Trail $trail, $station) {
                $trail->parent('frontend.index')
                    ->push(__('Stations'), route('frontend.stations.list'))
                    ->push($station->stationName, route('frontend.stations.station', $station->stationName));
            });
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


