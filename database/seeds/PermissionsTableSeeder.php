<?php

use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        ////////// Create permissions //////////
        $permissions = [];

        // Users
        $permissionGroup = PermissionGroup::create(['readable_name' => 'Users']);

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'access-users', 'readable_name' => 'Access users']);
        $permissions[] = 'access-users';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'create-users', 'readable_name' => 'Create users']);
        $permissions[] = 'create-users';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'edit-users', 'readable_name' => 'Edit users']);
        $permissions[] = 'edit-users';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'delete-users', 'readable_name' => 'Delete users']);
        $permissions[] = 'delete-users';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'restore-users', 'readable_name' => 'Restore users']);
        $permissions[] = 'restore-users';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'access-profile', 'readable_name' => 'Access profile']);
        $permissions[] = 'access-profile';

        Permission::create(['group_id' => $permissionGroup->id, 'name' => 'edit-profile', 'readable_name' => 'Edit profile']);
        $permissions[] = 'edit-profile';

        ////////// Create roles and assign existing permissions //////////
        $role = Role::create(['name' => 'administrator', 'readable_name' => 'Administrator']);
        $role->syncPermissions($permissions);
    }
}
