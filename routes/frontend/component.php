<?php

use App\Http\Controllers\Frontend\ComponentView;
use App\Models\ComponentItem;
use App\Models\ComponentType;
use Tabuna\Breadcrumbs\Trail;


Route::prefix('components')->group(function () {
    Route::get('/', [ComponentView::class, 'index'])
        ->name('component.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Components'), route('frontend.component.index'));
        });

    Route::get('/all', [ComponentView::class, 'index_all'])
        ->name('component.index.all')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('component'),  route('frontend.component.index'))
                ->push(__('All'), route('frontend.component.index.all'));
        });

    Route::get('/category/{componentType}', [ComponentView::class, 'viewCategory'])
        ->name('component.category')
        ->breadcrumbs(function (Trail $trail, ComponentType $componentType) {
            $trail->parent('frontend.index')
                ->push(__('Components'), route('frontend.component.index'));

            if ($componentType->parent()->first() != null) {
                // Level 1
                $level1 = $componentType->parent()->first();

                if ($level1->parent()->first() != null) {
                    // // Level 2
                    $level2 = $level1->parent()->first();
                    $trail->push($level2->title, route('frontend.component.category', $level2));
                }
                $trail->push($level1->title, route('frontend.component.category', $level1));
            }
            $trail->push($componentType->title);
        });

    Route::get('/item/{componentItem}', [ComponentView::class, 'viewItem'])
        ->name('component.item')
        ->breadcrumbs(function (Trail $trail, ComponentItem $componentItem) {
            $trail->parent('frontend.index')
                ->push(__('Components'), route('frontend.component.index'));

            if ($componentItem->component_type() != null) {
                $level0 = $componentItem->component_type;

                if ($level0->parent()->first() != null) {
                    // Level 1
                    $level1 = $level0->parent()->first();

                    if ($level1->parent()->first() != null) {
                        // // Level 2
                        $level2 = $level1->parent()->first();
                        $trail->push($level2->title, route('frontend.component.category', $level2));
                    }
                    $trail->push($level1->title, route('frontend.component.category', $level1));
                }
                $trail->push($level0->title, route('frontend.component.category', $level0));
            }

            $trail->push($componentItem->title);
        });
});
