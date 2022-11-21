<?php

namespace Tests\Feature\Backend\Order;

use Tests\TestCase;
use App\Models\Order;
use App\Models\ComponentItem;

use Illuminate\Foundation\Testing\RefreshDatabase;

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
    public function an_admin_can_access_the_delete_order_page()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();
        $this->get('/admin/orders/delete/' . $order->id)->assertOk();
    }

    /** @test */
    public function update_order_requires_validation()
    {
        $this->loginAsAdmin();
        $order = Order::factory()->create();

        $response = $this->put("/admin/orders/{$order->id}", []);
        $response->assertSessionHasErrors(['locker_id', 'user_id', 'status']);
    }


    // /** @test */
    // public function anyone_can_access_component_reserve_home()
    // {

    //     $componentItem = ComponentItem::factory()->create();
    //     //dd($componentItem);
    //     $response = $this->get('/products' . $componentItem->id);
    //     $response->assertStatus(200);
    // }
    // /** @test */
    // public function an_order_can_be_created()
    // {

    //     $response = $this->post('store-request', [
    //         'Name' => 'Tharmapalan Thanujan',
    //         'ENumber' => 'e17342',
    //         'OrderID' => '83',
    //         'Ordered Date' => '2022-08-23',
    //         'Describtion For Ordering' => 'frgtgtgt',
    //         'Expected Date To get' => '2022-08-23',
    //         'Select Lecturer' => 'Lecturer User'

    //     ]);
    //     $response->assertRedirect('/products');
    // }


    // /** @test */
    // public function unauthorized_user_cannot_delete_order_as_admin()
    // {
    //     $component = Order::factory()->create();
    //     $response = $this->delete('/admin/orders/' . $component->id);
    //     $response->assertStatus(302);
    // }

    // /** @test */
    // public function unauthorized_user_cannot_delete_order_as_user()
    // {
    //     $component = Order::factory()->create();
    //     $response = $this->delete('user/orders/' . $component->id);
    //     $response->assertStatus(302);
    // }

    // /** @test */
    // public function user_cannot_delete_order_once_placed()
    // {
    //     $component = Order::factory()->create();
    //     $response = $this->delete('user/orders/' . $component->id);
    //     $response->assertStatus(302);
    // }
}
