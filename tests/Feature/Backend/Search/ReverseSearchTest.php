<?php

namespace Backend\Search;

use App\Models\ComponentItem;
use App\Models\ConsumableItem;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReverseSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_load_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->get('/dashboard/reverseSearch');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_search_for_items()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => 1]);
        //        dd($response->content());
        $locationName = Locations::where('id', '1')->first()->name;
        $response->assertStatus(200);
        $response->assertSee($locationName);
    }

    /** @test */
    public function search_results_has_href()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '1']);
        $flag = false;
        if (str_contains($response->content(), '/dashboard/equipment/')) {
            $flag = true;
        }
        if (str_contains($response->content(), '/dashboard/components/items/')) {
            $flag = true;
        }
        if (str_contains($response->content(), '/dashboard/consumables/items/')) {
            $flag = true;
        }
        if (str_contains($response->content(), '/dashboard/machines/')) {
            $flag = true;
        }
        if (str_contains($response->content(), '/dashboard/raw_materials/')) {
            $flag = true;
        }

        //        check if any one of href is there
        self::assertTrue($flag);
    }

    /** @test */
    public function new_equipment_will_appear_in_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/equipment/items', [
            'title' => 'Sample Equipment',
            'brand' => 'Brand',
            'productCode' => '100-X',
            'quantity' => 1,
            'specifications' => NULL,
            'description' => 'Sample Description',
            'instructions' => 'Sample Instructions',
            'isElectrical' => 0,
            'powerRating' => NULL,
            'price' => 500.00,
            'width' => 10.00,
            'length' => 10.00,
            'height' => 5.00,
            'weight' => 100.00,
            'thumb' => NULL,
            'equipment_type_id' => 11
        ]);
        $createdItem = EquipmentItem::where('title', 'Sample Equipment')->first();
        ItemLocations::factory()->create([
            'item_id' => $createdItem->inventoryCode(),
            'location_id' => 2
        ]);
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '2']);
        $response->assertSee($createdItem->title);
    }

    /** @test */
    public function new_component_will_appear_in_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/components/items', [

            'title' => 'Sample Component',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'isAvailable' => '1',
            'price' => '80.00',
            'size' => 'small',
            'thumb' => NULL,
            'component_type_id' => 11,

        ]);
        $createdItem = ComponentItem::where('title', 'Sample Component')->first();
        ItemLocations::factory()->create([
            'item_id' => $createdItem->inventoryCode(),
            'location_id' => 1
        ]);
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '1']);
        $response->assertSee($createdItem->title);
    }

    /** @test */
    public function new_consumable_will_appear_in_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/consumables/items', [
            'title' => 'Sample consumable',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'powerRating' => '12',
            'formFactor' => 'some form factor',
            'voltageRating' => '1234',
            'datasheetURL' => 'some url',
            'price' => '80.00',
            'thumb' => NULL,
            'consumable_type_id' => 11,

        ]);
        $createdItem = ConsumableItem::where('title', 'Sample consumable')->first();
        ItemLocations::factory()->create([
            'item_id' => $createdItem->inventoryCode(),
            'location_id' => 2
        ]);
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '2']);
        $response->assertSee($createdItem->title);
    }

    /** @test */
    public function new_machine_will_appear_in_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/machines', [
            'title' => 'Sample Machine',
            'type' => array_rand(Machines::types()),
            'build_width' => 30,
            'build_length' => 40,
            'build_height' => 50,
            'power' => rand(30, 100),
            'thumb' => NULL,
            'specifications' => 'Sample specification',
            'status' => array_rand(Machines::availabilityOptions()),
            'notes' => 'Sample note',
            'lifespan' => rand(10, 3000)
        ]);
        $createdItem = Machines::where('title', 'Sample Machine')->first();
        ItemLocations::factory()->create([
            'item_id' => $createdItem->inventoryCode(),
            'location_id' => 1
        ]);
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '1']);
        $response->assertSee($createdItem->title);
    }

    /** @test */
    public function new_raw_material_will_appear_in_reverse_search()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/raw_materials', [
            'title' => 'Sample Raw Material',
            'color' => NULL,
            'description' => 'Sample description',
            'specifications' => 'Not applicable',
            'quantity' => '10',
            'unit' => 'pcs',
            'availability' => 'AVAILABLE',
            'thumb' => NULL
        ]);
        $createdItem = RawMaterials::where('title', 'Sample Raw Material')->first();
        ItemLocations::factory()->create([
            'item_id' => $createdItem->inventoryCode(),
            'location_id' => 1
        ]);
        $response = $this->post('/dashboard/reverseSearch/reverseResults', ['location' => '1']);
        $response->assertSee($createdItem->title);
    }
}