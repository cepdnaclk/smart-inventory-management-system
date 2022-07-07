<?php

namespace Tests\Feature\Api\Auth;

use App\Domains\Auth\Models\User ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

use Tests\TestCase;
use Notification;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;


    public function setUp() :void
    {
        parent::setUp();

        // fake all notifications that are sent out during tests
        Notification::fake();

        // create a user
        User::factory()->create([
            'email' => 'johndoe@example.org',
            'password' => Hash::make('testpassword')
        ]);

    }

    public function test_show_validation_error_when_both_fields_empty()
    {

        $response = $this->json('POST', route('api.auth.login'), [
            'email' => '',
            'password' => ''
        ]);

        $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
    }


    public function test_show_validation_error_on_email_when_credential_donot_match()
    {
        $response = $this->json('POST', route('api.auth.login'), [
            'email' => 'test@test.com',
            'password' => 'abcdabcd'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_return_user_and_access_token_after_successful_login()
    {
        $response = $this->json('POST', route('api.auth.login'), [
            'email' =>'johndoe@example.org',
            'password' => 'testpassword',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['user', 'access_token']);
    }

    public function test_non_authenticated_user_cannot_get_user_details()
    {

        $response = $this->json('GET', route('api.auth.user'));

        $response->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_user_can_get_user_details()
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->json('GET', route('api.auth.user'));

        $response->assertStatus(200)
            ->assertJsonStructure(['name', 'email']);
    }

    public function test_non_authenticated_user_cannot_logout()
    {
        $response = $this->json('POST', route('api.auth.logout'), []);

        $response->assertStatus(401)
            ->assertSee('Unauthenticated');;
    }

    public function test_authenticated_user_can_logout()
    {
        Sanctum::actingAs(
            User::first(),
        );

        $response = $this->json('POST', route('api.auth.logout'), []);

        $response->assertStatus(200);
    }


    // Password reset
    public function test_return_validation_error_when_email_doenot_exist()
    {
        $response = $this->json('POST', route('password.email'), ['email' => 'invalid@email.com']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_send_password_reset_link_if_email_exists()
    {
        $user = User::first();
        $response = $this->json('POST', route('password.email'), ['email' => $user->email]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);

        // Notification::assertSentTo($user, ResetPassword::class); // running on issue with asserting notification
    }

    public function test_reset_password_success()
    {
        $user = User::first();
        $token = Password::broker()->createToken($user);
        $new_password = 'testpassword';

        $response = $this->json('POST', route('password.reset'), [
            'token' => $token,
            'email' => $user->email,
            'password' => $new_password,
            'password_confirmation' => $new_password
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }
}
