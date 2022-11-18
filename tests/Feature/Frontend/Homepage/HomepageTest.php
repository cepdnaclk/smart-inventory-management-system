<?php

namespace Tests\Feature\Frontend\Homepage;

use App\Models\ComponentType;
use App\Models\EquipmentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Backend\Equipment\EquipmentTypeTest;
use Tests\TestCase;

class HomepageTest extends TestCase
{

    /** @test */
    public function admin_can_load_homepage()
    {
        $this->loginAsAdmin();
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function homepage_has_link_to_equipment()
    {
        $response = $this->get('/');
        $response->assertSee("Equipment");
        $response->assertSee("/equipment");
    }

    /** @test */
    public function homepage_has_link_to_components()
    {
        $response = $this->get('/');
        $response->assertSee("Components");
        $response->assertSee("/components");
    }

    /** @test */
    public function homepage_has_link_to_consumables()
    {
        $response = $this->get('/');
        $response->assertSee("Consumables");
        $response->assertSee("/consumables");
    }

    /** @test */
    public function components_shows_categories(){
        $response = $this->get('/components');
        $categoryTitle = ComponentType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }

    /** @test */
    public function equipment_shows_categories(){
        $response = $this->get('/equipment');
        $categoryTitle = EquipmentType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }
}
