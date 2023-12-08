<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'read articles']);
        Permission::create(['name' => 'update articles']);
        Permission::create(['name' => 'delete articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Super Admin']);

        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('create articles');
        $role2->givePermissionTo('read articles');
        $role2->givePermissionTo('update articles');
        $role2->givePermissionTo('delete articles');

        $role3 = Role::create(['name' => 'Officer']);
        $role3->givePermissionTo('create articles');
        $role3->givePermissionTo('read articles');

        // create demo users
        $user1 = User::findOrFail(1);
        $user1->assignRole($role1);

        $user2 = User::findOrFail(2);
        $user2->assignRole($role2);

        $user3 = User::findOrFail(3);
        $user3->assignRole($role3);
    }
}
