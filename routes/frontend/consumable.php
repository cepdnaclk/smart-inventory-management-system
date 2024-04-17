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

            if ($consumableType->parent()->first() != null) {
                // Level 1
                $level1 = $consumableType->parent()->first();

                if ($level1->parent()->first() != null) {
                    // // Level 2
                    $level2 = $level1->parent()->first();
                    $trail->push($level2->title, route('frontend.consumable.category', $level2));
                }
                $trail->push($level1->title, route('frontend.consumable.category', $level1));
            }
            $trail->push($consumableType->title);
        });

    Route::get('/item/{consumableItem}', [ConsumableView::class, 'viewItem'])
        ->name('consumable.item')
        ->breadcrumbs(function (Trail $trail, ConsumableItem $consumableItem) {
            $trail->parent('frontend.index')
                ->push(__('Consumables'), route('frontend.consumable.index'));

            if ($consumableItem->consumable_type != null) {
                $level0 = $consumableItem->consumable_type;
                if ($level0->parent()->first() != null) {
                    // Level 1
                    $level1 = $level0->parent()->first();

                    if ($level1->parent()->first() != null) {
                        // // Level 2
                        $level2 = $level1->parent()->first();
                        $trail->push($level2->title, route('frontend.consumable.category', $level2));
                    }
                    $trail->push($level1->title, route('frontend.consumable.category', $level1));
                }
                $trail->push($level0->title, route('frontend.consumable.category', $level0));
            }

            $trail->push($consumableItem->title);
        });
});
