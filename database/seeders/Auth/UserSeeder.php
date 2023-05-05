<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'email' => env('SEED_ADMIN_EMAIL', 'admin@example.com'),
            'password' => env('SEED_ADMIN_PASSWORD', 'admin_user'),
            'email_verified_at' => now(),
            'active' => true,
        ]);

        if (app()->environment(['local', 'testing'])) {
            User::create([
                'type' => User::TYPE_USER,
                'name' => 'Test User',
                'email' => env('SEED_USER_EMAIL', 'user@example.com'),
                'password' => env('SEED_USER_PASSWORD', 'regular_user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            $lecturer = User::create([
                'type' => User::TYPE_LECTURER,
                'name' => 'Lecturer User',
                'email' => env('SEED_LECTURER_EMAIL', 'lecturer@example.com'),
                'password' => env('SEED_LECTURER_PASSWORD', 'lecturer_user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            $hod = User::create([
                'type' => User::TYPE_LECTURER,
                'name' => 'HOD User',
                'email' => env('SEED_HOD_EMAIL', 'hod@example.com'),
                'password' => env('SEED_HOD_PASSWORD', 'hod_user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            $techOfficer = User::create([
                'type' => User::TYPE_TECH_OFFICER,
                'name' => 'Technical Officer User',
                'email' => env('SEED_TECH_OFFICER_EMAIL', 'techofficer@example.com'),
                'password' => env('SEED_TECH_OFFICER_PASSWORD', 'tech_officer_user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            $maintainer = User::create([
                'type' => User::TYPE_MAINTAINER,
                'name' => 'Maintainer User',
                'email' => env('SEED_MAINTAINER_EMAIL', 'maintainer@example.com'),
                'password' => env('SEED_MAINTAINER_PASSWORD', 'maintainer_user'),
                'email_verified_at' => now(),
                'active' => true,
            ]);
        }

        $this->enableForeignKeys();
    }
}
