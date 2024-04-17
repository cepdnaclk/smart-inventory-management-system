<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $userRole = Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);

        $lecturerRole = Role::create([
            'id' => 2,
            'type' => User::TYPE_LECTURER,
            'name' => 'Lecturer',
        ]);

        $techOfficer = Role::create([
            'id' => 3,
            'type' => User::TYPE_TECH_OFFICER,
            'name' => 'Technical Officer',
        ]);

        $maintainer = Role::create([
            'id' => 4,
            'type' => User::TYPE_MAINTAINER,
            'name' => 'Maintainer',
        ]);

        // Non Grouped Permissions
        //

        // Grouped permissions
        // Users category
        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user',
            'description' => 'All User Permissions',
        ]);
        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.deactivate',
                'description' => 'Deactivate Users',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.reactivate',
                'description' => 'Reactivate Users',
                'sort' => 3,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 4,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.impersonate',
                'description' => 'Impersonate Users',
                'sort' => 5,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 6,
            ]),
        ]);

        $lecturers = Permission::create([
            'type' => User::TYPE_LECTURER,
            'name' => 'lecturer.access',
            'description' => 'All Lecturer Permissions',
        ]);
        $lecturers->children()->saveMany([
            new Permission([
                'type' => User::TYPE_LECTURER,
                'name' => 'lecturer.access.all',
                'description' => 'Access All',
            ])
        ]);

        $techOfficers = Permission::create([
            'type' => User::TYPE_TECH_OFFICER,
            'name' => 'techOfficer.access',
            'description' => 'All Technical Officer Permissions',
        ]);
        // $techOfficers->children()->saveMany([
        //     new Permission([
        //         'type' => User::TYPE_TECH_OFFICER,
        //         'name' => 'techofficer.access.all',
        //         'description' => 'Access All',
        //     ])
        // ]);

        $maintainers = Permission::create([
            'type' => User::TYPE_MAINTAINER,
            'name' => 'maintainer.access',
            'description' => 'All Maintainer Permissions',
        ]);
        // $maintainer->children()->saveMany([
        //     new Permission([
        //         'type' => User::TYPE_MAINTAINER,
        //         'name' => 'maintainer.access.all',
        //         'description' => 'Access All',
        //     ])
        // ]);


        // Assign Permissions to other Roles
        //

        $this->enableForeignKeys();
    }
}
