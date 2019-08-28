<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Phước Trung',
            'email' => 'trungkenbi@hotmail.com',
            'password' => bcrypt('23456789'),
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        /* ============== */

        $user = User::create([
            'name' => 'Ngọc Minh',
            'email' => 'ngocminhit2000@gmail.com',
            'password' => bcrypt('23456789'),
        ]);

        $role = Role::create(['name' => 'Manager']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
