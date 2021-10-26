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
            'title_ar' => 'app',
            'title_en' => 'app',
            'terms_ar' => 'app',
            'terms_en' => 'app',
            'privacy_ar' => 'app',
            'privacy_en' => 'app',
            'about_us_ar' => 'app',
            'about_us_en' => 'app',
            'facebook' => '',
            'youtube' => '',
            'instagram' => '',
            'twitter' => '',
            'linkedin' => '',
            'logo' => '',

        ]);
    }
}
