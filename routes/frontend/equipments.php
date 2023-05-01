<?php

use App\Http\Controllers\Frontend\EquipmentView;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('equipment')->group(function () {
    Route::get('/', [EquipmentView::class, 'index'])
        ->name('equipment.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Equipment'), route('frontend.equipment.index'));
        });

    Route::get('/all', [EquipmentView::class, 'index_all'])
        ->name('equipment.index.all')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Equipment'),  route('frontend.equipment.index'))
                ->push(__('All'), route('frontend.equipment.index.all'));
        });

    Route::get('/category/{equipmentType}', [EquipmentView::class, 'viewCategory'])
        ->name('equipment.category')
        ->breadcrumbs(
            function (Trail $trail, EquipmentType $equipmentType) {
                $trail->parent('frontend.index')
                    ->push(__('Equipment'), route('frontend.equipment.index'));

                if ($equipmentType->parent()->first() != null) {
                    // Level 1
                    $level1 = $equipmentType->parent()->first();

                    if ($level1->parent()->first() != null) {
                        // // Level 2
                        $level2 = $level1->parent()->first();
                        $trail->push($level2->title, route('frontend.equipment.category', $level2));
                    }
                    $trail->push($level1->title, route('frontend.equipment.category', $level1));
                }
                $trail->push($equipmentType->title);
            }
        );

    Route::get('/item/{equipmentItem}', [EquipmentView::class, 'viewItem'])
        ->name('equipment.item')
        ->breadcrumbs(function (Trail $trail, EquipmentItem $equipmentItem) {
            $trail->parent('frontend.index')
                ->push(__('Equipments'), route('frontend.equipment.index'));

            if ($equipmentItem->equipment_type() != null) {
                $level0 = $equipmentItem->equipment_type;

                if ($level0->parent()->first() != null) {
                    // Level 1
                    $level1 = $level0->parent()->first();

                    if ($level1->parent()->first() != null) {
                        // // Level 2
                        $level2 = $level1->parent()->first();
                        $trail->push($level2->title, route('frontend.equipment.category', $level2));
                    }
                    $trail->push($level1->title, route('frontend.equipment.category', $level1));
                }
                $trail->push($level0->title, route('frontend.equipment.category', $level0));
            }

            $trail->push($equipmentItem->title);
        });
});
