<?php

use App\Http\Controllers\StationController;


Route::get('/stations', function(){
    return view('frontend.stations.index');
});

//list the stations
Route::get('/stations', [StationController::class, 'index'])->name('stations');

