<?php

namespace Tests\Feature\Backend\Consumable;

use App\Domains\Auth\Models\User;
use App\Models\ConsumableType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ConsumableTypeTest.
 */
class ConsumableTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_consumable_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/consumables/types/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_consumable_type_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/consumables/types/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_consumable_type_page()
    {
        $this->loginAsAdmin();
        $consumableType = ConsumableType::factory()->create();
        $this->get('/dashboard/consumables/types/' . $consumableType->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_consumable_type_page()
    {
        $this->loginAsAdmin();
        $consumableType = ConsumableType::factory()->create();
        $this->get('/dashboard/consumables/types/delete/' . $consumableType->id)->assertOk();
    }

    /** @test */
    public function create_consumable_type_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/consumables/types/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_consumable_type_requires_validation()
    {
        $this->loginAsAdmin();
        $consumableType = ConsumableType::factory()->create();
        $response = $this->put("/dashboard/consumables/types/{$consumableType->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function an_consumable_type_can_be_created()
    {
        $this->loginAsAdmin();

        $response = $this->post('/dashboard/consumables/types', [
            'title' => 'Sample Consumable Type',
            'parent_id' => NULL,
            'subtitle' => '',
            'description' => ' ',
            'thumb' => NULL,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('consumable_types', [
            'title' => 'Sample Consumable Type',
        ]);
    }

    /** @test */
    public function an_consumable_type_can_be_updated()
    {

        $this->actingAs(User::factory()->admin()->create());
        $consumableType = ConsumableType::factory()->create();

        $consumableType->title = 'New Consumable Type Title';
        $response = $this->put("/dashboard/consumables/types/{$consumableType->id}", $consumableType->toArray());

        $this->assertDatabaseHas('consumable_types', [
            'title' => 'New Consumable Type Title',
        ]);
    }

    /** @test */
    public function delete_consumable_type_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $consumableType = ConsumableType::factory()->create();
        $this->delete('/dashboard/consumables/types/' . $consumableType->id);
        $this->assertDatabaseMissing('consumable_types', ['id' => $consumableType->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_consumable_type_item()
    {
        $consumableType = ConsumableType::factory()->create();
        $response = $this->delete('/dashboard/consumables/types/' . $consumableType->id);
        $response->assertStatus(302);
    }
}
