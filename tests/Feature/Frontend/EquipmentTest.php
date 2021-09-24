<?php

namespace Tests\Feature\Frontend;

use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class EquipmentTest.
 */
class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_access_equipment_home()
    {
        $this->get('/equipment')->assertOk();
    }

    /** @test */
    public function anyone_can_access_equipment_category(){
        $equipmentType = EquipmentType::factory()->create();
        $this->get('/equipment/category/' . $equipmentType->id)->assertOk();
    }

    /** @test */
    public function anyone_can_access_equipment_item(){
        $equipment = EquipmentItem::factory()->create();
        $this->get('/equipment/item/' . $equipment->id)->assertOk();
    }

}
