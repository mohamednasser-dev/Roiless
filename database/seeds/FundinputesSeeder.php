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
            'slug' => 'الاسم_الثلاثي',
        ]);
        Fundinput::create([
            'name' => 'صوره البطاقه',
            'slug' => 'صوره_البطاقه',
        ]);
        Fundinput::create([
            'name' => 'صوره الفيش',
            'slug' => 'صوره_الفيش',
        ]);
    }
}
