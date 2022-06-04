<?php

/*
 * API Routes
 */
Route::group(['as' => 'api.'], function () {
    includeRouteFiles(__DIR__.'/Api/');
});


