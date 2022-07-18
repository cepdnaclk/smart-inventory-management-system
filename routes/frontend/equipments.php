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
        ->breadcrumbs(function (Trail $trail, EquipmentType $equipmentType) {
            $trail->parent('frontend.index')
                ->push(__('Equipment'), route('frontend.equipment.index'));

            if ($equipmentType->parent_id() != null) {
                if ($equipmentType->parent()->parent_id() != null) {
                    if ($equipmentType->parent()->parent()->parent()->parent_id() != null) {
                        $trail->push($equipmentType->parent()->parent()->parent()->title, route('frontend.equipment.category',
                            $equipmentType->parent()->parent()->parent()));
                    }
                    $trail->push($equipmentType->parent()->parent()->title, route('frontend.equipment.category',
                        $equipmentType->parent()->parent()));
                }
                $trail->push($equipmentType->parent()->title, route('frontend.equipment.category',
                    $equipmentType->parent()));
            }

            $trail->push($equipmentType->title);
        });

    Route::get('/item/{equipmentItem}', [EquipmentView::class, 'viewItem'])
        ->name('equipment.item')
        ->breadcrumbs(function (Trail $trail, EquipmentItem $equipmentItem) {
            $trail->parent('frontend.index')
                ->push(__('Equipments'), route('frontend.equipment.index'));


            if ($equipmentItem->equipment_type() != null) {
                $type = $equipmentItem->equipment_type;

                if ($type->parent_id() != null) {
                    if ($type->parent()->parent_id() != null) {
                        if ($type->parent()->parent()->parent_id() != null) {
                            $trail->push($type->parent()->parent()->parent()->title, route('frontend.equipment.category',
                                $type->parent()->parent()->parent()));
                        }
                        $trail->push($type->parent()->parent()->title, route('frontend.equipment.category',
                            $type->parent()->parent()));
                    }
                    $trail->push($type->parent()->title, route('frontend.equipment.category',
                        $type->parent()));
                }
            }

            $trail->push($equipmentItem->title);
        });

});
