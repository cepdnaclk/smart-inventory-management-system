<?php

namespace Tests\Feature\Backend\Machines;

use App\Domains\Auth\Models\User;
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
        $this->get('/admin/machines/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_machine_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/machines/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_machine_page()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $this->get('/admin/machines/' . $machine->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_machine_page()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $this->get('/admin/machines/delete/' . $machine->id)->assertOk();
    }

    /** @test */
    public function create_machine_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/machines/');
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function update_machine_requires_validation()
    {
        $this->loginAsAdmin();
        $machine = Machines::factory()->create();
        $response = $this->put("/admin/machines/{$machine->id}", []);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function a_machine_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/admin/machines', [
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

        $response = $this->post('/admin/machines/')->assertStatus(302);

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
        $machine->title = 'New Machine Title';
        $response = $this->put("/admin/machines/{$machine->id}", $machine->toArray());

        $this->assertDatabaseHas('machines', [
            'title' => 'New Machine Title',
        ]);
    }

    /** @test */
    public function delete_machine_item()
    {
        $this->actingAs(User::factory()->admin()->create());
        $machine = Machines::factory()->create();
        $this->delete('/admin/machines/' . $machine->id);
        $this->assertDatabaseMissing('machines', ['id' => $machine->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_machine_item()
    {
        $machine = Machines::factory()->create();
        $response = $this->delete('/admin/machines/' . $machine->id);
        $response->assertStatus(302);
    }
}
