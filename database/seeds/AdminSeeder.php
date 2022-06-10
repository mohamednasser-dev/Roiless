<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = \App\Models\City::first();
        $role = Role::create(['name' => 'owner', 'guard_name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);


        $admin = Admin::create([
            'name' => 'admin',
            'phone' => '012',
            'image' => '',
            'email' => 'admin@admin.com',
            'type' => 'admin',
            'status' => 'active',
            'role_id' => $role->id,
            'city_id' => $city->id,
            'password' => bcrypt('123456'),
        ]);
        $admin->assignRole($role);


    }

}
