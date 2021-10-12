<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = [
            'home',
            'roles',
            'Users',
            'Employers',
            'Banks',
            'funds',
            'Client Funds',
            'categories',
            'Common questions',
            'Services',
            'consolutions',
            'notifications',
            'communication',
            'Setting',
        ];
        foreach ($Permissions as $Permission) {
            Permission::create(['name' => $Permission, 'guard_name'=>'admin']);
        }

    }
}
