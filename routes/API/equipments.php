<?php

use App\Http\Controllers\Api\EquipmentItemController;
use App\Models\EquipmentType;

Route::get('/equipments', function () {
    return response()->json([
        "Equipment Types",
        "Equipment Items"
    ],200);
});


//component Items --------------------------------------------------------------------

//Index
Route::get('equipments/items', [EquipmentItemController::class, 'index']);
// Show
Route::get('equipments/items/{componentItem}', [EquipmentItemController::class, 'show']);

Route::group([ 'middleware' => ['auth:sanctum','role:'.config('boilerplate.access.role.admin')]], function () {

    // Store
    Route::post('equipments/items', [EquipmentItemController::class, 'store']);

    // Update
    Route::put('equipments/items/{componentItem}', [EquipmentItemController::class, 'update']);

    // Destroy
    Route::delete('equipments/items/{componentItem}', [EquipmentItemController::class, 'destroy']);
});



// Component Types -------------------------------------------------------------

// Index
Route::get('equipments/types', [EquipmentType::class, 'index']);

// Show
Route::get('equipments/types/{componentType}', [EquipmentType::class, 'show']);


Route::group([ 'middleware' => ['auth:sanctum','role:'.config('boilerplate.access.role.admin')]], function () {

        // Store
        Route::post('equipments/types/', [EquipmentType::class, 'store']);

        // Update
        Route::put('equipments/types/{componentType}', [EquipmentType::class, 'update']);
    
        // Destroy
        Route::delete('equipments/types/{componentType}', [EquipmentType::class, 'destroy']);
    
});

