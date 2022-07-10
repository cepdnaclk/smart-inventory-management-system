<?php

namespace Tests\Feature\Backend\LocationService;

use App\Http\Livewire\LocationsToggler;
use App\Models\ComponentItem;
use App\Models\ConsumableItem;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LocationsTogglerLivewireTest extends TestCase
{
    /** @test */
    public function addLocation_function_adds_equipment_item_location_to_db()
    {
        $this->loginAsAdmin();

        $equipment = EquipmentItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $equipment])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseHas('item_locations', [
            'item_id' => $equipment->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_adds_component_item_location_to_db()
    {
        $this->loginAsAdmin();

        $component = ComponentItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $component])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseHas('item_locations', [
            'item_id' => $component->inventoryCode(),
            'location_id' => 1,
        ]);
    }


    /** @test */
    public function addLocation_function_adds_consumable_item_location_to_db()
    {
        $this->loginAsAdmin();

        $consumable = ConsumableItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $consumable])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseHas('item_locations', [
            'item_id' => $consumable->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_adds_machine_location_to_db()
    {
        $this->loginAsAdmin();

        $machine = Machines::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $machine])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseHas('item_locations', [
            'item_id' => $machine->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_adds_raw_materials_location_to_db()
    {
        $this->loginAsAdmin();

        $rawMaterials = RawMaterials::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $rawMaterials])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseHas('item_locations', [
            'item_id' => $rawMaterials->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_removes_equipment_item_location_from_db()
    {
        $this->loginAsAdmin();

        $equipment = EquipmentItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $equipment->inventoryCode(),
            'location_id' => 1,
        ]);
        Livewire::test(LocationsToggler::class, ['itemModel' => $equipment])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseMissing('item_locations', [
            'item_id' => $equipment->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_removes_component_item_location_from_db()
    {
        $this->loginAsAdmin();

        $component = ComponentItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $component->inventoryCode(),
            'location_id' => 1,
        ]);
        Livewire::test(LocationsToggler::class, ['itemModel' => $component])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseMissing('item_locations', [
            'item_id' => $component->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_removes_consumable_item_location_from_db()
    {
        $this->loginAsAdmin();

        $consumable = ConsumableItem::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $consumable->inventoryCode(),
            'location_id' => 1,
        ]);
        Livewire::test(LocationsToggler::class, ['itemModel' => $consumable])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseMissing('item_locations', [
            'item_id' => $consumable->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_removes_machines_location_from_db()
    {
        $this->loginAsAdmin();

        $machine = Machines::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $machine->inventoryCode(),
            'location_id' => 1,
        ]);
        Livewire::test(LocationsToggler::class, ['itemModel' => $machine])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseMissing('item_locations', [
            'item_id' => $machine->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_removes_raw_materials_location_from_db()
    {
        $this->loginAsAdmin();

        $rawMaterials = RawMaterials::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $rawMaterials->inventoryCode(),
            'location_id' => 1,
        ]);
        Livewire::test(LocationsToggler::class, ['itemModel' => $rawMaterials])
            ->set('locationID', 1)
            ->call('addLocation');

        $this->assertDatabaseMissing('item_locations', [
            'item_id' => $rawMaterials->inventoryCode(),
            'location_id' => 1,
        ]);
    }

    /** @test */
    public function addLocation_function_equipment_location_change_shows_up_in_frontend()
    {
        $this->loginAsAdmin();

        $equipment = EquipmentItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $equipment])
            ->set('locationID', 1)
            ->call('addLocation');

        $locationName = Locations::where('id', 1)->first()->location;
        $this->get('/equipment/item/' . $equipment->id)
            ->assertSee($locationName);
    }

    /** @test */
    public function addLocation_function_component_location_change_shows_up_in_frontend()
    {
        $this->loginAsAdmin();

        $component = ComponentItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $component])
            ->set('locationID', 1)
            ->call('addLocation');

        $locationName = Locations::where('id', 1)->first()->location;
        $this->get('/components/item/' . $component->id)
            ->assertSee($locationName);
    }

    /** @test */
    public function addLocation_function_consumable_location_change_shows_up_in_frontend()
    {
        $this->loginAsAdmin();

        $consumable = ConsumableItem::factory()->create();
        Livewire::test(LocationsToggler::class, ['itemModel' => $consumable])
            ->set('locationID', 1)
            ->call('addLocation');

        $locationName = Locations::where('id', 1)->first()->location;
        $this->get('/consumables/item/' . $consumable->id)
            ->assertSee($locationName);
    }

    /** @test */
    public function location_toggler_page_has_livewire()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $response = $this->get(route('admin.equipment.items.edit.location', $equipment->id));
        $response->assertSeeLivewire('locations-toggler');
    }

    /** @test */
    public function location_toggler_shows_all_available_locations()
    {
        $this->loginAsAdmin();
        $equipment = EquipmentItem::factory()->create();
        $response = $this->get(route('admin.equipment.items.edit.location', $equipment->id));

        $allLocations = Locations::all();
        foreach ($allLocations as $location) {
            if ($location->id == 1) {
                // skip the root location as its not shown anyway
                $response->assertDontSee($location->location);
            } else {
                $response->assertSee($location->location);
            }
        }

    }

    /** @test */
    public function creating_new_equipment_redirects_to_locations_toggler()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.equipment.items.store', [
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
        ]));
        $equipmentItem = EquipmentItem::where('title', 'Sample Equipment')->first();
        $response->assertRedirect(route('admin.equipment.items.edit.location', $equipmentItem->id));
    }

    /** @test */
    public function creating_new_component_redirects_to_locations_toggler()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.component.items.store', [
            'title' => 'Sample Component',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'location' => '1',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'isAvailable' => '1',
            'price' => '80.00',
            'size' => 'small',
            'thumb' => NULL,
            'component_type_id' => 11,
        ]));
        $componentItem = ComponentItem::where('title', 'Sample Component')->first();
        $response->assertRedirect(route('admin.component.items.edit.location', $componentItem->id));
    }

    /** @test */
    public function creating_new_consumable_redirects_to_locations_toggler()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.consumable.items.store', [
            'title' => 'Sample Consumable',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'location' => '1',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'isAvailable' => '1',
            'price' => '80.00',
            'size' => 'small',
            'thumb' => NULL,
            'consumable_type_id' => 11,
        ]));
        $consumableItem = ConsumableItem::where('title', 'Sample Consumable')->first();
        $response->assertRedirect(route('admin.consumable.items.edit.location', $consumableItem->id));
    }

    /** @test */
    public function creating_new_raw_materials_redirects_to_locations_toggler()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.raw_materials.store', [
            'title' => 'Sample Raw Material',
            'color' => NULL,
            'description' => 'Sample description',
            'specifications' => 'Not applicable',
            'quantity' => '10',
            'location' => 1,
            'unit' => 'pcs',
            'availability' => 'AVAILABLE',
            'thumb' => NULL
        ]));
        $rawMaterialItem = RawMaterials::where('title', 'Sample Raw Material')->first();
        $response->assertRedirect(route('admin.raw_materials.edit.location', $rawMaterialItem->id));
    }

    /** @test */
    public function creating_new_machines_redirects_to_locations_toggler()
    {
        $this->loginAsAdmin();
        $response = $this->post(route('admin.machines.store', [
            'title' => 'Sample Machine',
            'type' => array_rand(Machines::types()),
            'build_width' => 30,
            'build_length' => 40,
            'location' => 1,
            'build_height' => 50,
            'power' => rand(30, 100),
            'thumb' => NULL,
            'specifications' => 'Sample specification',
            'status' => array_rand(Machines::availabilityOptions()),
            'notes' => 'Sample note',
            'lifespan' => rand(10, 3000)
        ]));
        $machineItem = Machines::where('title', 'Sample Machine')->first();
        $response->assertRedirect(route('admin.machines.edit.location', $machineItem->id));
    }

}
