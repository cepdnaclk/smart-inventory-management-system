<?php

use App\Http\Controllers\Api\EquipmentItemController;
use App\Http\Controllers\Api\EquipmentTypeController;

Route::get('/equipments', function () {
    return response()->json([
        "Equipment Types",
        "Equipment Items"
    ],200);
});


//equipment Items --------------------------------------------------------------------

//Index
Route::get('equipments/items', [EquipmentItemController::class, 'index']);

//search
Route::get('equipments/items/search/', [EquipmentItemController::class, 'search']);

// Show
Route::get('equipments/items/{componentItem}', [EquipmentItemController::class, 'show']);

// equipment Types -------------------------------------------------------------

// Index
Route::get('equipments/types', [EquipmentTypeController::class, 'index']);

// Show
Route::get('equipments/types/{componentType}', [EquipmentTypeController::class, 'show']);

//search
Route::get('equipments/types/search/', [EquipmentTypeController::class, 'search']);


      

Route::group(['prefix'=>'admin'],function () {
    Route::group([ 'middleware' => ['auth:sanctum','role:'.config('boilerplate.access.role.admin')]], function () {

        // Store
        Route::post('equipments/items', [EquipmentItemController::class, 'store']);
    
        // Update
        Route::put('equipments/items/{componentItem}', [EquipmentItemController::class, 'update']);
    
        // Destroy
        Route::delete('equipments/items/{componentItem}', [EquipmentItemController::class, 'destroy']);

         // Store
         Route::post('equipments/types/', [EquipmentTypeController::class, 'store']);

         // Update
         Route::put('equipments/types/{componentType}', [EquipmentTypeController::class, 'update']);
     
         // Destroy
         Route::delete('equipments/types/{componentType}', [EquipmentTypeController::class, 'destroy']);
    });
});





 
    