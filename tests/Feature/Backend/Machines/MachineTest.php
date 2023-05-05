<?php

namespace Tests\Feature\Backend\Machines;

use App\Domains\Auth\Models\User;
use App\Models\ItemLocations;
use App\Models\Machines;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MachineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_machine_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/machines/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_machine_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/machines/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_machine_page()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $this->get('/dashboard/machines/' . $machine->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_machine_page()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $this->get('/dashboard/machines/delete/' . $machine->id)->assertOk();
    }

    /** @test */
    public function create_machine_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/machines/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_machine_requires_validation()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $response = $this->put("/dashboard/machines/{$machine->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_machine_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/machines', [
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

        $response = $this->post('/dashboard/machines/')->assertStatus(302);

        $this->assertDatabaseHas('machines', [
            'title' => 'Sample Machine',
            'build_height' => 50,
        ]);
    }

    /** @test */
    public function a_machine_can_be_updated()
    {
        $this->actingAs(User::factory()->admin()->create());
        $machine = Machines::factory()->create();
        ItemLocations::factory()->create([
            'item_id' => $machine->inventoryCode(),
            'location_id' => 2
        ]);
        $machine->title = 'New Machine Title';
        $machineArray = $machine->toArray();
        $machineArray['location'] = 2;

        $response = $this->put("/dashboard/machines/{$machine->id}", $machineArray);
        $response->assertStatus(302);
        $this->assertDatabaseHas('machines', [
            'title' => 'New Machine Title',
        ]);
    }

    /** @test */
    public function delete_machine_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $machine = Machines::factory()->create();
        $this->delete('/dashboard/machines/' . $machine->id);
        $this->assertDatabaseMissing('machines', ['id' => $machine->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_machine_item()
    {
        $machine = Machines::factory()->create();
        $response = $this->delete('/dashboard/machines/' . $machine->id);
        $response->assertStatus(302);
    }
}
