<?php

namespace Tests\Feature\Backend\Consumable;

use App\Domains\Auth\Models\User;
use App\Models\ConsumableItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ConsumableItemTest.
 */
class ConsumableItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_consumable_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/consumables/items/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_consumable_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/consumables/items/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_consumable_page()
    {
        $this->loginAsAdmin();
        $consumable = ConsumableItem::factory()->create();
        $this->get('/admin/consumables/items/' . $consumable->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_consumable_page()
    {
        $this->loginAsAdmin();
        $consumable = ConsumableItem::factory()->create();
        $this->get('/admin/consumables/items/delete/' . $consumable->id)->assertOk();
    }

    /** @test */
    public function create_consumable_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/consumables/items/');
        $response->assertSessionHasErrors(['title', 'consumable_type_id']);
    }

    /** @test */
    public function update_consumable_requires_validation()
    {
        $this->loginAsAdmin();
        $consumable = ConsumableItem::factory()->create();

        $response = $this->put("/admin/consumables/items/{$consumable->id}", []);
        $response->assertSessionHasErrors(['title', 'consumable_type_id']);
    }

    /** @test */
    public function an_consumable_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/consumables/items', [

            'title' => 'Sample consumable',
            'specifications' => 'UA741CP OpAmp 1MHz',
            'description' => 'The 741 Op Amp IC is a monolithic integrated circuit, comprising of a general purpose Operational Amplifier.',
            'instructions' => 'NO INSTRUCTION AVAILABLE',
            'powerRating' => '12',
            'location' => '2',
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
    }

    /** @test */
    public function an_consumable_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $consumable = ConsumableItem::factory()->create();

        $consumable->title = 'New consumable Title';
        $consumable_array = $consumable->toArray();
        $consumable_array['location'] = 1;
        $response = $this->put("/admin/consumables/items/{$consumable->id}",$consumable_array );

        $this->assertDatabaseHas('consumable_items', [
            'title' => 'New consumable Title',
        ]);
    }

    /** @test */
    public function delete_consumable_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $consumable = ConsumableItem::factory()->create();
        $this->delete('/admin/consumables/items/' . $consumable->id);
        $this->assertDatabaseMissing('consumable_items', ['id' => $consumable->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_consumable_item()
    {
        $consumable = ConsumableItem::factory()->create();
        $response = $this->delete('/admin/consumables/items/' . $consumable->id);
        $response->assertStatus(302);
    }

}
