<?php

namespace Tests\Feature\Backend\Order;

use Tests\TestCase;
use App\Models\Order;
use App\Models\ComponentItem;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

/**
 * Class DashboardTest.
 */
class OrderTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    /** @test */
    public function an_admin_can_access_the_list_order_page()
    {
        $this->loginAsAdmin();
        $this->get('/admin/orders/')->assertOk();
    }

    /** @test */
    public function an_admin_can_access_the_show_order_page()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();
        $this->get('/admin/orders/' . $order->id)->assertOk();
    }

    /** @test */
    public function an_admin_can_update_order()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();

        $this->put("/admin/orders/{$order->id}", ['status' => 'WAITING_LECTURER_APPROVAL', 'ordered_date' => Carbon::now(), "due_date_to_return" => Carbon::now()])->assertOk();
    }

    /** @test */
    public function an_admin_update_order_requires_validation()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();

        $response = $this->put("/admin/orders/{$order->id}", []);
        $response->assertSessionHasErrors(['status']);
    }



    /** @test */
    public function an_admin_can_access_the_delete_order_page()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();
        $this->get('/admin/orders/delete/' . $order->id)->assertOk();
    }


    /** @test */
    public function unauthorized_user_cannot_show_a_order_as_admin()
    {
        $order = Order::factory()->create();
        $response = $this->get('/admin/orders/' . $order->id);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function unauthorized_cannot_access_the_list_order_page_as_admin()
    {
        $this->loginAsAdmin();
        $this->get('/admin/orders/')->assertOk();
    }

    /** @test */
    public function unauthorized_user_cannot_delete_order_as_admin()
    {
        $component = Order::factory()->create();
        $response = $this->delete('/admin/orders/' . $component->id);
        $response->assertStatus(302);
    }
}
