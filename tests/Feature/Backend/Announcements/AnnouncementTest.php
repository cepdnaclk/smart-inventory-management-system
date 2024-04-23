<?php

namespace Tests\Feature\Backend\Announcements;

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
    public function an_admin_can_access_the_list_Announcements_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/announcements/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_create_Announcement_page()
    {
        $this->loginAsAdmin();
        $this->get('/dashboard/announcements/create')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_delete_Announcement_page()
    {
        $this->loginAsAdmin();
        $Announcement = Announcement::factory()->create();
        $this->get('/dashboard/announcements/delete/' . $Announcement->id)->assertOk();
    }

    /** @test */
    public function create_Announcement_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->post('/dashboard/announcements');
        $response->assertSessionHasErrors(['area', 'type', 'message', 'starts_at', 'ends_at']);
    }

    /** @test */
    public function update_Announcement_requires_validation()
    {
        $this->loginAsAdmin();
        $Announcement = Announcement::factory()->create();

        $response = $this->put("/dashboard/announcements/{$Announcement->id}", []);
        $response->assertSessionHasErrors(['area', 'type', 'message', 'starts_at', 'ends_at']);
    }

    /** @test */
    public function an_Announcement_can_be_created()
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
        $this->assertDatabaseHas('Announcements', [
            'message' => 'This is a sample',
        ]);
    }

    /** @test */
    public function an_component_can_be_updated()
    {
        $this->actingAs(User::factory()->admin()->create());
        $Announcement = Announcement::factory()->create();

        $Announcement->message = 'This can be updated';
        $Announcement_array = $Announcement->toArray();
        $Announcement_array['starts_at'] = date("Y-m-d\\TH:i");
        $Announcement_array['ends_at'] = date("Y-m-d\\TH:i");

        $response = $this->put("/dashboard/announcements/{$Announcement->id}", $Announcement_array);
        $response->assertStatus(302);

        $this->assertDatabaseHas('Announcements', [
            'message' => 'This can be updated',
        ]);
    }

    /** @test */
    public function delete_Announcement()
    {
        $this->actingAs(User::factory()->admin()->create());
        $Announcement = Announcement::factory()->create();
        $this->delete('/dashboard/announcements/' . $Announcement->id);
        $this->assertDatabaseMissing('Announcements', ['id' => $Announcement->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_Announcement()
    {
        $Announcement = Announcement::factory()->create();
        $response = $this->delete('/dashboard/announcements/' . $Announcement->id);
        $response->assertStatus(302);
    }
}
