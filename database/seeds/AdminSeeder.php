<?php

use App\Models\User;
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
        User::create([
            'name'  => 'admin',
            'phone'  => '01000000000',
            'image'  => '',
            'email'  => 'admin@admin.com',
            'type'  => 'admin',
            'status'  => 'active',
            'role_id'  => '',
            'password'  => bcrypt('123456'),

        ]);
    }
}