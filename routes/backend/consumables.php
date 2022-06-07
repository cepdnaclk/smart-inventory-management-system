<?php

use App\Http\Controllers\Backend\ConsumableItemController;
use App\Http\Controllers\Backend\ConsumableTypeController;
use Tabuna\Breadcrumbs\Trail;


Route::get('/consumables', function () {
    return view('backend.consumable.index');
})->name('consumable.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'));
    });


//consumable Items --------------------------------------------------------------------

//Index
Route::get('consumables/items', [ConsumableItemController::class, 'index'])
    ->name('consumable.items.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'))
            ->push(__('Items'));
    });

// Create
Route::get('consumables/items/create', [ConsumableItemController::class, 'create'])
    ->name('consumable.items.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'))
            ->push(__('Items'), route('admin.consumable.items.index'))
            ->push(__('Create'));
    });

// Store
Route::post('consumables/items', [ConsumableItemController::class, 'store'])
    ->name('consumable.items.store');

// Show
Route::get('consumables/items/{consumableItem}', [ConsumableItemController::class, 'show'])
    ->name('consumable.items.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'))
            ->push(__('Items'), route('admin.consumable.items.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('consumables/items/edit/{consumableItem}', [ConsumableItemController::class, 'edit'])
    ->name('consumable.items.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'))
            ->push(__('Items'), route('admin.consumable.items.index'))
            ->push(__('Edit'));
    });


// Update
Route::put('consumables/items/{consumableItem}', [ConsumableItemController::class, 'update'])
    ->name('consumable.items.update');

// Delete
Route::get('consumables/items/delete/{consumableItem}', [ConsumableItemController::class, 'delete'])
    ->name('consumable.items.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Consumables'), route('admin.consumable.index'))
            ->push(__('Items'), route('admin.consumable.items.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('consumables/items/{consumableItem}', [ConsumableItemController::class, 'destroy'])
    ->name('consumable.items.destroy');

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
