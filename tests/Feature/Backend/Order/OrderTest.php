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

    public function anyone_can_access_my_orders()
    {

        $myorders = Order::factory()->create();
        //  dd($myorders);
        $this->get('/show-my-order' . $myorders->id)->assertOk();
        // $response = $this->put("/admin/machines/{$machine->id}", []);


    }

    /** @test */
    public function anyone_can_access_component_reserve_home()
    {

        $componentItem = ComponentItem::factory()->create();
        //dd($componentItem);
        $response = $this->get('/products' . $componentItem->id);
        $response->assertStatus(200);
    }
    /** @test */
    public function anyone_can_send_order_request()
    {

        $response = $this->post('store-request', [
            'Name' => 'rasathurai karan',
            'ENumber' => 'e18168',
            'OrderID' => '83',
            'Ordered Date' => '2022-08-23',
            'Describtion For Ordering' => 'frgtgtgt',
            'Expected Date To get' => '2022-08-23',
            'Select Lecturer' => 'Lecturer User'

        ]);
        $response->assertRedirect('/products');
    }
}
