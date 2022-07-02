<?php

use App\Http\Controllers\Frontend\ConsumableView;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('consumables')->group(function () {
    Route::get('/', [ConsumableView::class, 'index'])
        ->name('consumable.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Consumables'), route('frontend.consumable.index'));
        });

    Route::get('/all', [ConsumableView::class, 'index_all'])
                ->name('consumable.index.all')
                ->breadcrumbs(function (Trail $trail) {
                    $trail->parent('frontend.index')
                        ->push(__('Consumables'),  route('frontend.consumable.index'))
                        ->push(__('All'), route('frontend.consumable.index.all'));
                });
                
    Route::get('/category/{consumableType}', [ConsumableView::class, 'viewCategory'])
        ->name('consumable.category')
        ->breadcrumbs(function (Trail $trail, ConsumableType $consumableType) {
            $trail->parent('frontend.index')
                ->push(__('Consumables'), route('frontend.consumable.index'));

            if ($consumableType->parent() != null) {
                // Only look upto two parents for now

                if ($consumableType->parent()->parent() != null) {
                    $trail->push($consumableType->parent()->parent()->title, route('frontend.consumable.category',
                        $consumableType->parent()->parent()));
                }

                $trail->push($consumableType->parent()->title, route('frontend.consumable.category',
                    $consumableType->parent()));
            }
            $trail->push($consumableType->title);
        });

    Route::get('/item/{consumableItem}', [ConsumableView::class, 'viewItem'])
        ->name('consumable.item')
        ->breadcrumbs(function (Trail $trail,ConsumableItem $consumableItem) {
            $trail->parent('frontend.index')
                ->push(__('Consumables'), route('frontend.consumable.index'));
            if ($consumableItem->consumable_type() != null) {
                // Only look upto one parents for now
                $type = $consumableItem->consumable_type;

                if ($type->parent() != null) {
                    $trail->push($type->parent()->title, route('frontend.consumable.category',
                        $type->parent()));
                }

                $trail->push($type->title, route('frontend.consumable.category',
                    $type));
            }

            $trail->push($consumableItem->title);
        });

});
