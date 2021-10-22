<?php

use App\Http\Controllers\Backend\RawMaterialsController;
use Tabuna\Breadcrumbs\Trail;

//Index
Route::get('raw_materials', [RawMaterialsController::class, 'index'])
    ->name('raw_materials.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Raw Materials'));
    });

// Create
Route::get('raw_materials/create', [RawMaterialsController::class, 'create'])
    ->name('row_materials.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Raw Materials'), route('admin.raw_materials.index'))
            ->push(__('Create'));
    });

// Store
Route::post('machines', [RawMaterialsController::class, 'store'])
    ->name('row_materials.store');

// Show
Route::get('raw_materials/{rawMaterials}', [RawMaterialsController::class, 'show'])
    ->name('row_materials.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Raw Materials'), route('admin.raw_materials.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('raw_materials/edit/{rawMaterials}', [RawMaterialsController::class, 'edit'])
    ->name('row_materials.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Raw Materials'), route('admin.raw_materials.index'))
            ->push(__('Edit'));
    });


// Update
Route::put('raw_materials/{rawMaterials}', [RawMaterialsController::class, 'update'])
    ->name('row_materials.update');

// Delete
Route::get('raw_materials/delete/{rawMaterials}', [RawMaterialsController::class, 'delete'])
    ->name('row_materials.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Raw Materials'), route('admin.raw_materials.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('raw_materials/{rawMaterials}', [RawMaterialsController::class, 'destroy'])
    ->name('row_materials.destroy');
