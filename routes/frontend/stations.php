<?php

use App\Http\Controllers\AddStationController;
use App\Http\Controllers\Frontend\StationController;


Route::prefix('stations')->group(function () {

    Route::get('/stations', function(){
        return view('frontend.stations.index');
    });

    //list the stations
    Route::get('/', [StationController::class, 'index'])->name('stations');

    // To list tools of a station
    Route::get('/{station}',[StationController::class, 'viewStation'])->name('stations');

    


});


