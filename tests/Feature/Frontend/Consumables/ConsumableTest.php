<?php

namespace Tests\Feature\Frontend\Consumables;

use App\Models\ConsumableType;
use Tests\TestCase;

class ConsumableTest extends TestCase
{
    /** @test */
    public function consumables_shows_categories(){
        $response = $this->get('/consumables');
        $categoryTitle = ConsumableType::inRandomOrder()->first()->title;
        $response->assertSee($categoryTitle);
    }


}
