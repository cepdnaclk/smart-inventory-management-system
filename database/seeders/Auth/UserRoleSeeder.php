<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        User::find(1)->assignRole(config('boilerplate.access.role.admin'));

        //no need in production
        if (app()->environment(['local', 'testing'])) {
            // Assign permissions for the s
            User::where('type', User::TYPE_LECTURER)->first()->assignRole('Lecturer');

            // Assign permissions for the technicalOfficer users
            User::where('type', User::TYPE_TECH_OFFICER)->first()->assignRole('Technical Officer');

            // Assign permissions for the maintainer users
            User::where('type', User::TYPE_MAINTAINER)->first()->assignRole('Maintainer');

            $this->enableForeignKeys();
        }
    }
}
