<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name'  => 'user',
            'phone'  => '010',
            'image'  => '',
            'email'  => 'user@user.com',
            'type'  => 'user',
            'status'  => 'active',
            'verified'  => 1,
            'password'  => bcrypt('123456'),


        ]);
    }
}
