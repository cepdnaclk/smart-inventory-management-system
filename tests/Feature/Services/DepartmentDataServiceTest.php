<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use App\Services\DepartmentDataService;

class DepartmentDataServiceTest extends TestCase
{
    /** @test */
    public function can_check_about_the_existence_of_an_user_email_()
    {
        $api = new DepartmentDataService();
        $this->assertTrue($api->isInternalEmail('nuwanjaliyagoda@eng.pdn.ac.lk'));
        $this->assertFalse($api->isInternalEmail('user@example.com'));
    }
}
