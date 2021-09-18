<?php

use App\Models\Fundinput;
use App\Models\User;
use Illuminate\Database\Seeder;

class FundinputesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fundinput::create([
            'name' => 'الاسم الثلاثي',
            'slug' => 'user_name',
        ]);
        Fundinput::create([
            'name' => 'رقم الجوال',
            'slug' => 'phone',
        ]);
        Fundinput::create([
            'name' => 'البريد الإلكتروني',
            'slug' => 'email',
        ]);
    }
}
