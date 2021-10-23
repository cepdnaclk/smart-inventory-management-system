<?php

use App\Http\Controllers\Api\ComponentItemController;
use App\Http\Controllers\Api\ComponentTypeController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/components', function () {
    return response()->json([
        "Component Types",
        "Component Items"
    ],200);
});


//component Items --------------------------------------------------------------------

//Index
Route::get('components/items', [ComponentItemController::class, 'index']);
// Show
Route::get('components/items/{componentItem}', [ComponentItemController::class, 'show']);

Route::group([ 'middleware' => 'admin'], function () {
    // Store
    Route::post('components/items', [ComponentItemController::class, 'store']);

    // Update
    Route::put('components/items/{componentItem}', [ComponentItemController::class, 'update']);

    // Destroy
    Route::delete('components/items/{componentItem}', [ComponentItemController::class, 'destroy']);
});



// Component Types -------------------------------------------------------------

// Index
Route::get('components/types', [ComponentTypeController::class, 'index']);

// Show
Route::get('components/types/{componentType}', [ComponentTypeController::class, 'show']);


Route::group([ 'middleware' => 'admin'], function () {
        // Store
        Route::post('components/types/', [ComponentTypeController::class, 'store']);

        // Update
        Route::put('components/types/{componentType}', [ComponentTypeController::class, 'update']);
    
        // Destroy
        Route::delete('components/types/{componentType}', [ComponentTypeController::class, 'destroy']);
    
});

