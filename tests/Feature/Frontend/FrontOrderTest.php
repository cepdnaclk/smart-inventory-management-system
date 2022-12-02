<?php

namespace Tests\Feature\Frontend;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;


/**
 * Class FrontOrderTest.
 */
class FrontOrderTest extends TestCase
{


    /** @test */
    public function user_can_Access_an_order_page()
    {
        $this->loginAsUser();

        $response = $this->get('show-my-order');
        $response->assertOk();
    }

    /** @test */
    public function an_order_cannot_be_created_by_unauthorized_user()
    {


        $response = $this->post('store-request', [
            'Name' => 'Tharmapalan Thanujan',
            'ENumber' => 'e17342',
            'OrderID' => '83',
            'Ordered Date' => '2022-08-23',
            'Describtion For Ordering' => 'frgtgtgt',
            'Expected Date To get' => '2022-08-23',
            'Select Lecturer' => 'Lecturer User'

        ]);
        $response->assertRedirect('/login');
    }







    /** @test */
    public function unauthorized_user_cannot_delete_order_as_user()
    {
        $component = Order::factory()->create();
        $response = $this->delete('user/orders/' . $component->id);
        $response->assertStatus(404);
    }

    /** @test */
    public function user_cannot_delete_order_once_placed()
    {
        $component = Order::factory()->create();
        $response = $this->delete('user/orders/' . $component->id);
        $response->assertStatus(404);
    }
}
