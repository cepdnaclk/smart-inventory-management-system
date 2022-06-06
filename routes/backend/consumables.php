<?php

use App\Http\Controllers\Backend\ConsumableTypeController;
use Tabuna\Breadcrumbs\Trail;

// Consumable Types -------------------------------------------------------------

// Index

Route::get('consumables/types', [ConsumableTypeController::class, 'index'])
    ->name('consumable.types.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), '/')
            ->push(__('Types'));
    });

// Create
Route::get('consumables/types/create', [ConsumableTypeController::class, 'create'])
    ->name('consumable.types.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), '/')
            ->push(__('Types'), route('admin.consumable.types.index'))
            ->push(__('Create'));
    });

// Store
Route::post('consumables/types/', [ConsumableTypeController::class, 'store'])
    ->name('consumable.types.store');

// Show
Route::get('consumables/types/{consumableType}', [ConsumableTypeController::class, 'show'])
    ->name('consumable.types.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), '/')
            ->push(__('Types'), route('admin.consumable.types.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('consumables/types/edit/{consumableType}', [ConsumableTypeController::class, 'edit'])
    ->name('consumable.types.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), '/')
            ->push(__('Types'), route('admin.consumable.types.index'))
            ->push(__('Edit'));
    });

// Update
Route::put('consumables/types/{consumableType}', [ConsumableTypeController::class, 'update'])
    ->name('consumable.types.update');

// Delete
Route::get('consumables/types/delete/{consumableType}', [ConsumableTypeController::class, 'delete'])
    ->name('consumable.types.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), '/')
            ->push(__('Types'), route('admin.consumable.types.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('consumables/types/{consumableType}', [ConsumableTypeController::class, 'destroy'])
    ->name('consumable.types.destroy');
