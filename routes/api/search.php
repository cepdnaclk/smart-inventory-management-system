<?php


use App\Http\Controllers\Api\SearchController;

Route::get('/search',[SearchController::class,'search']);