<?php
use App\Http\Controllers\Backend\ComponentItemController;
use App\Http\Controllers\Backend\ComponentTypeController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/component', function () {
    return view('backend.component.index');
})->name('component.index');


//component Items --------------------------------------------------------------------

//Index
Route::get('component/items', [ComponentItemController::class, 'index'])
    ->name('component.items.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Items'));
    });

// Create
Route::get('component/items/create', [ComponentItemController::class, 'create'])
    ->name('component.items.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Items'), route('admin.component.items.index'))
            ->push(__('Create'));
    });

// Store
Route::post('component/items', [ComponentItemController::class, 'store'])
    ->name('component.items.store');

// Show
Route::get('component/items/{componentItem}', [ComponentItemController::class, 'show'])
->name('component.items.show')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Component'), route('admin.component.index'))
        ->push(__('Items'), route('admin.component.items.index'))
        ->push(__('Show'));
});

// Edit
Route::get('component/items/edit/{componentItem}', [ComponentItemController::class, 'edit'])
    ->name('component.items.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Items'), route('admin.component.items.index'))
            ->push(__('Edit'));
    });


// Update
Route::put('component/items/{componentItem}', [ComponentItemController::class, 'update'])
    ->name('component.items.update');

// Delete
Route::get('component/items/delete/{componentItem}', [ComponentItemController::class, 'delete'])
    ->name('component.items.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Items'), route('admin.component.items.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('component/items/{componentItem}', [ComponentItemController::class, 'destroy'])
    ->name('component.items.destroy');

// Component Types -------------------------------------------------------------

// Index
Route::get('component/types', [ComponentTypeController::class, 'index'])
    ->name('component.types.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Types'));
    });

// Create
Route::get('component/types/create', [ComponentTypeController::class, 'create'])
    ->name('component.types.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Types'), route('admin.component.types.index'))
            ->push(__('Create'));
    });

// Store
Route::post('component/types/', [ComponentTypeController::class, 'store'])
    ->name('component.types.store');

// Show
Route::get('component/types/{componentType}', [ComponentTypeController::class, 'show'])
    ->name('component.types.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Types'), route('admin.component.types.index'))
            ->push(__('Show'));
    });

// Edit
Route::get('component/types/edit/{componentType}', [ComponentTypeController::class, 'edit'])
    ->name('component.types.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Types'), route('admin.component.types.index'))
            ->push(__('Edit'));
    });

// Update
Route::put('component/types/{componentType}', [ComponentTypeController::class, 'update'])
    ->name('component.types.update');

// Delete
Route::get('component/types/delete/{componentType}', [ComponentTypeController::class, 'delete'])
    ->name('component.types.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Component'), route('admin.component.index'))
            ->push(__('Types'), route('admin.component.types.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('component/types/{componentType}', [ComponentTypeController::class, 'destroy'])
    ->name('component.types.destroy');
