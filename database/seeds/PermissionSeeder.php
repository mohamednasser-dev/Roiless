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

            'Users',
            'Employers',
            'roles',
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
            'investments',
        ];
        foreach ($Permissions as $Permission) {
            Permission::create(['name' => $Permission, 'guard_name'=>'admin']);
        }

    }
}
