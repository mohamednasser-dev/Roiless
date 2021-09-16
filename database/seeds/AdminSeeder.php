<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'  => 'admin',
            'phone'  => '012',
            'image'  => '',
            'email'  => 'admin@admin.com',
            'type'  => 'admin',
            'status'  => 'active',
            'password'  => bcrypt('123456'),


        ]);
        Admin::create([
            'name'  => 'employer',
            'phone'  => '010',
            'image'  => '',
            'email'  => 'employer@employer.com',
            'type'  => 'employer',
            'status'  => 'active',
            'password'  => bcrypt('123456'),


        ]);
    }
}
