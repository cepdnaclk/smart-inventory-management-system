<?php

use App\Http\Controllers\AddStationController;
use App\Http\Controllers\Frontend\StationController;




    Route::get('/stations', function(){
        return view('frontend.stations.index');
    });

    //list the stations
    Route::get('/stations', [StationController::class, 'index'])->name('stations');

    // To list tools of a station
    Route::get('/stations/{station}',[StationController::class, 'viewStation'])->name('stations');

    Route::resource('/addstation', AddStationController::class);


