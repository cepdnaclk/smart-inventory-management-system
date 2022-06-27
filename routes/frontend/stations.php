<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\AddStationController;
use App\Http\Controllers\Frontend\StationController;


Route::prefix('stations')->group(function () {

    Route::get('/stations', function(){
        return view('frontend.stations.index');
    });

    //list the stations
    Route::get('/', [StationController::class, 'index'])
        ->name('stations.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Stations'), route('frontend.stations.index'));
        });

    // To list tools of a station
    Route::get('/{station}',[StationController::class, 'viewStation'])->name('stations');

    


});


