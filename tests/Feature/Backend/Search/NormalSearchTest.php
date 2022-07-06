<?php

namespace Backend\Search;

use App\Models\Machines;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NormalSearchTest extends TestCase
{
//    This is named normal search because there is reverse search too.
    use RefreshDatabase;

    /** @test */
    public function admin_can_load_search_page()
    {
        $this->loginAsAdmin();
        $response = $this->get('/admin/search');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_search_for_items()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => 'test']);
        $response->assertStatus(200);
    }

    /** @test */
    public function will_show_error_when_keyword_is_empty()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => '']);
        $response->assertViewHas("status", "Search string is empty. Please type something");
    }

    /** @test */
    public function view_has_search_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => 'resistor']);
        $response->assertViewHas("searchResults");
    }

    /** @test */
    public function search_results_has_href()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => 'resistor']);
        $response->assertViewHas("keywords");
    }

    /** @test */
    public function search_results_has_resistor_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => 'resistor']);
        $response->assertSee("Ω");
    }

    /** @test */
    public function search_results_links_are_working()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => 'resistor']);
        $response->assertSee("/admin/consumables/items/1001");
    }

    /** @test */
    public function search_results_has_0_results_please_check_spellings_text()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/search/results', ['keywords' => '1234123235145345234212341241413']);
        $response->assertSee("Please check your spellings");
    }

    /** @test */
    public function newly_added_equipment_is_shown_in_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/equipment/items', [
            'title' => 'Sample Equipment',
            'brand' => 'Brand',
            'location' => '0',
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
        $response->assertStatus(302);
        $this->assertDatabaseHas('equipment_items', [
            'title' => 'Sample Equipment',
        ]);
//        search for equipment
        $response = $this->post('/admin/search/results', ['keywords' => 'Equipment']);
//        check if sample equipment is there
        $response->assertSee("Sample Equipment");
    }

    /** @test */
    public function newly_added_consumable_is_shown_in_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/consumables/items', [

            'title' => 'Sample consumable',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'powerRating' => '12',
            'location' => 1,
            'formFactor' => 'some form factor',
            'voltageRating' => '1234',
            'datasheetURL' => 'some url',
            'price' => '80.00',
            'thumb' => NULL,
            'consumable_type_id' => 11,

        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('consumable_items', [
            'title' => 'Sample consumable',
        ]);
//        search for consumable
        $response = $this->post('/admin/search/results', ['keywords' => 'consumable']);
//        check if sample consumable is there
        $response->assertSee("Sample consumable");
    }

    /** @test */
    public function newly_added_component_is_shown_in_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/components/items', [

            'title' => 'Sample Component',
            'brand' => NULL,
            'productCode' => 'ICOA101',
            'location'=>'1',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'isAvailable' => '1',
            'price' => '80.00',
            'size' => 'small',
            'thumb' => NULL,
            'component_type_id' => 11,

        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('component_items', [
            'title' => 'Sample Component',
        ]);
//        search for consumable
        $response = $this->post('/admin/search/results', ['keywords' => 'Component']);
//        check if sample consumable is there
        $response->assertSee("Sample Component");
    }

    /** @test */
    public function newly_added_machine_is_shown_in_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/machines', [
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
        ]);

        $response = $this->post('/admin/machines/')->assertStatus(302);

        $this->assertDatabaseHas('machines', [
            'title' => 'Sample Machine',
            'build_height' => 50,
        ]);
//        search for machine
        $response = $this->post('/admin/search/results', ['keywords' => 'machine']);
//        check if sample consumable is there
        $response->assertSee("Sample Machine");
    }

    /** @test */
    public function newly_added_rawMaterial_is_shown_in_results()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/raw_materials', [
            'title' => 'Sample Raw Material',
            'color' => NULL,
            'description' => 'Sample description',
            'specifications' => 'Not applicable',
            'quantity' => '10',
            'location' => 1,
            'unit' => 'pcs',
            'availability' => 'AVAILABLE',
            'thumb' => NULL
        ]);

        $response = $this->post('/admin/raw_materials/')->assertStatus(302);
        $this->assertDatabaseHas('raw_materials', [
            'title' => 'Sample Raw Material',
        ]);
//        search for Material
        $response = $this->post('/admin/search/results', ['keywords' => 'Material']);
//        check if Sample Raw Material is there
        $response->assertSee("Sample Raw Material");
    }

}
