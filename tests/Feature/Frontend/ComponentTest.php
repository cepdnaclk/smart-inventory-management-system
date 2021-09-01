<?php

namespace Tests\Feature\Frontend;

use App\Models\ComponentItem;
use App\Models\ComponentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ComponentTest.
 */
class ComponentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_access_component_home()
    {
        $this->get('/component')->assertOk();
    }

    /** @test */
    public function anyone_can_access_component_category(){
        $componentType = ComponentType::factory()->create();
        $this->get('/component/category/' . $componentType->id)->assertOk();
    }

    /** @test */
    public function anyone_can_access_component_item(){
        $component = ComponentItem::factory()->create();
        $this->get('/component/item/' . $component->id)->assertOk();
    }

}