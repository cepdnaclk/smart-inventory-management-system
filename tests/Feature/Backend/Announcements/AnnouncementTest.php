<?php

namespace Tests\Feature\Backend\Annuncements;

use App\Domains\Auth\Models\User;
use App\Domains\Announcement\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AnnouncementTest.
 */
class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_list_announcements_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/announcements/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_announcement_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/announcements/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_announcement_page()
    {
        $this->loginAsAdmin();
        $announcement = Announcement::factory()->create();
        $this->get('/dashboard/announcements/delete/' . $announcement->id)->assertOk();
    }

    /** @test */
    public function create_announcement_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/announcements');
        $response->assertSessionHasErrors(['area', 'type', 'message', 'starts_at', 'ends_at']);
    }

    /** @test */
    public function update_announcement_requires_validation()
    {
        $this->loginAsAdmin();
        $announcement = Announcement::factory()->create();

        $response = $this->put("/dashboard/announcements/{$announcement->id}", []);
        $response->assertSessionHasErrors(['area', 'type', 'message', 'starts_at', 'ends_at']);
    }

    /** @test */
    public function an_announcement_can_be_created()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/announcements/', [
            'area' => Announcement::TYPE_BACKEND,
            'type' => array_keys(Announcement::types())[0],
            'message' => 'This is a sample',
            'enabled' => 'true',
            'starts_at' => '2023-01-01T00:00',
            'ends_at' => '2023-01-02T00:00',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('announcements', [
            'message' => 'This is a sample',
        ]);
    }

    /** @test */
    public function an_component_can_be_updated()
    {
        $this->actingAs(User::factory()->admin()->create());
        $announcement = Announcement::factory()->create();

        $announcement->message = 'This can be updated';
        $announcement_array = $announcement->toArray();
        $announcement_array['starts_at'] = date("Y-m-d\\TH:i");
        $announcement_array['ends_at'] = date("Y-m-d\\TH:i");

        $response = $this->put("/dashboard/announcements/{$announcement->id}", $announcement_array);
        $response->assertStatus(302);

        $this->assertDatabaseHas('announcements', [
            'message' => 'This can be updated',
        ]);
    }

    /** @test */
    public function delete_announcement()
    {
        $this->actingAs(User::factory()->admin()->create());
        $announcement = Announcement::factory()->create();
        $this->delete('/dashboard/announcements/' . $announcement->id);
        $this->assertDatabaseMissing('announcements', ['id' => $announcement->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_announcement()
    {
        $announcement = Announcement::factory()->create();
        $response = $this->delete('/dashboard/announcements/' . $announcement->id);
        $response->assertStatus(302);
    }
}
