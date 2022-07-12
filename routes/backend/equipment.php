<?php

use App\Http\Controllers\Backend\EquipmentItemController;
use App\Http\Controllers\Backend\EquipmentTypeController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware(['editAccess'])->group(function () {

    Route::get('/equipment', function () {
        return view('backend.equipment.index');
    })->name('equipment.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'));
        });

    // Equipment Items -------------------------------------------------------------

    // Index
    Route::get('equipment/items', [EquipmentItemController::class, 'index'])
        ->name('equipment.items.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'));
        });

    // Create
    Route::get('equipment/items/create', [EquipmentItemController::class, 'create'])
        ->name('equipment.items.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'), route('admin.equipment.items.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('equipment/items', [EquipmentItemController::class, 'store'])
        ->name('equipment.items.store');

    // Show
    Route::get('equipment/items/{equipmentItem}', [EquipmentItemController::class, 'show'])
        ->name('equipment.items.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'), route('admin.equipment.items.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('equipment/items/edit/{equipmentItem}', [EquipmentItemController::class, 'edit'])
        ->name('equipment.items.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'), route('admin.equipment.items.index'))
                ->push(__('Edit'));
        });

    // Edit location
    Route::get('equipment/items/edit/location/{equipmentItem}', [EquipmentItemController::class, 'editLocation'])
        ->name('equipment.items.edit.location')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'), route('admin.equipment.items.index'))
                ->push(__('Edit Location'));
        });

    // Update
    Route::put('equipment/items/{equipmentItem}', [EquipmentItemController::class, 'update'])
        ->name('equipment.items.update');

    // Delete
    Route::get('equipment/items/delete/{equipmentItem}', [EquipmentItemController::class, 'delete'])
        ->name('equipment.items.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Items'), route('admin.equipment.items.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('equipment/items/{equipmentItem}', [EquipmentItemController::class, 'destroy'])
        ->name('equipment.items.destroy');


    // Equipment Types -------------------------------------------------------------

    // Index
    Route::get('equipment/types', [EquipmentTypeController::class, 'index'])
        ->name('equipment.types.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Types'));
        });

    // Create
    Route::get('equipment/types/create', [EquipmentTypeController::class, 'create'])
        ->name('equipment.types.create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Types'), route('admin.equipment.types.index'))
                ->push(__('Create'));
        });

    // Store
    Route::post('equipment/types/', [EquipmentTypeController::class, 'store'])
        ->name('equipment.types.store');

    // Show
    Route::get('equipment/types/{equipmentType}', [EquipmentTypeController::class, 'show'])
        ->name('equipment.types.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Types'), route('admin.equipment.types.index'))
                ->push(__('Show'));
        });

    // Edit
    Route::get('equipment/types/edit/{equipmentType}', [EquipmentTypeController::class, 'edit'])
        ->name('equipment.types.edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Types'), route('admin.equipment.types.index'))
                ->push(__('Edit'));
        });

    // Update
    Route::put('equipment/types/{equipmentType}', [EquipmentTypeController::class, 'update'])
        ->name('equipment.types.update');

    // Delete
    Route::get('equipment/types/delete/{equipmentType}', [EquipmentTypeController::class, 'delete'])
        ->name('equipment.types.delete')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Equipment'), route('admin.equipment.index'))
                ->push(__('Types'), route('admin.equipment.types.index'))
                ->push(__('Delete'));
        });

    // Destroy
    Route::delete('equipment/types/{equipmentType}', [EquipmentTypeController::class, 'destroy'])
        ->name('equipment.types.destroy');

});
