<?php

use App\Http\Controllers\Backend\EquipmentItemController;
use App\Http\Controllers\Backend\EquipmentTypesController;
use Tabuna\Breadcrumbs\Trail;

Route::redirect('/equipments', '/admin/equipments/items', 301);


// Equipment Items -------------------------------------------------------------

// Index
Route::get('equipments/items', [EquipmentItemController::class, 'index'])
    ->name('equipments.items.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Items'));
    });

// Create
Route::get('equipments/items/create', [EquipmentItemController::class, 'create'])
    ->name('equipments.items.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Items'), route('admin.equipments.items.index'))
            ->push(__('Create'));
    });

// Store
Route::post('equipments/items/{equipmentItem}', [EquipmentItemController::class, 'store'])
    ->name('equipments.items.store');

// Show
Route::get('equipments/items/{equipmentItem}', [EquipmentItemController::class, 'show'])
    ->name('equipments.items.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Items'), route('admin.equipments.items.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('equipments/items/edit/{equipmentItem}', [EquipmentItemController::class, 'edit'])
    ->name('equipments.items.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Items'), route('admin.equipments.items.index'))
            ->push(__('Edit'));
    });

// Update
Route::put('equipments/items/{equipmentItem}', [EquipmentItemController::class, 'update'])
    ->name('equipments.items.update');

// Delete
Route::get('equipments/items/delete/{equipmentItem}', [EquipmentItemController::class, 'delete'])
    ->name('equipments.items.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Items'), route('admin.equipments.items.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('equipments/items/{equipmentItem}', [EquipmentTypesController::class, 'destroy'])
    ->name('equipments.items.destroy');



// Equipment Types -------------------------------------------------------------

// Index
Route::get('equipments/types', [EquipmentTypesController::class, 'index'])
    ->name('equipments.types.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Types'));
    });

// Create
Route::get('equipments/types/create', [EquipmentTypesController::class, 'create'])
    ->name('equipments.types.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Types'), route('admin.equipments.types.index'))
            ->push(__('Create'));
    });

// Store
Route::post('equipments/types/', [EquipmentTypesController::class, 'store'])
    ->name('equipments.types.store');

// Show
Route::get('equipments/types/{equipmentType}', [EquipmentTypesController::class, 'show'])
    ->name('equipments.types.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Types'), route('admin.equipments.types.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('equipments/types/edit/{equipmentType}', [EquipmentTypesController::class, 'edit'])
    ->name('equipments.types.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Types'), route('admin.equipments.types.index'))
            ->push(__('Edit'));
    });

// Update
Route::put('equipments/types/{equipmentType}', [EquipmentTypesController::class, 'update'])
    ->name('equipments.types.update');

// Delete
Route::get('equipments/types/delete/{equipmentType}', [EquipmentTypesController::class, 'delete'])
    ->name('equipments.types.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Equipments'))
            ->push(__('Types'), route('admin.equipments.types.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('equipments/types/{equipmentType}', [EquipmentTypesController::class, 'destroy'])
    ->name('equipments.types.destroy');
