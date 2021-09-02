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

    Route::get('/category/{componentType}', [ComponentView::class, 'viewCategory'])
        ->name('component.category')
        ->breadcrumbs(function (Trail $trail, ComponentType $componentType) {
            $trail->parent('frontend.index')
                ->push(__('Components'), route('frontend.component.index'));

            if ($componentType->parent() != null) {
                // Only look upto two parents for now

                if ($componentType->parent()->parent() != null) {
                    $trail->push($componentType->parent()->parent()->title, route('frontend.component.category',
                        $componentType->parent()->parent()));
                }

                $trail->push($componentType->parent()->title, route('frontend.component.category',
                    $componentType->parent()));
            }
            $trail->push($componentType->title);
        });

    Route::get('/item/{componentItem}', [ComponentView::class, 'viewItem'])
        ->name('component.item')
        ->breadcrumbs(function (Trail $trail, ComponentItem $componentItem) {
            $trail->parent('frontend.index')
                ->push(__('Components'), route('frontend.component.index'));

            if ($componentItem->component_type() != null) {
                // Only look upto one parents for now
                $type = $componentItem->component_type;

                if ($type->parent() != null) {
                    $trail->push($type->parent()->title, route('frontend.component.category',
                        $type->parent()));
                }

                $trail->push($type->title, route('frontend.component.category',
                    $type));
            }

            $trail->push($componentItem->title);
        });

});
