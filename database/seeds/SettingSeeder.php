<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title_ar' => '',
            'title_en' => '',
            'terms_ar' => '',
            'terms_en' => '',
            'privacy_ar' => '',
            'privacy_en' => '',
            'facebook' => '',
            'youtube' => '',
            'gmail' => '',
            'instagram' => '',
            'twitter' => '',
            'linkedin' => '',
            'logo' => '',

        ]);
    }
}
