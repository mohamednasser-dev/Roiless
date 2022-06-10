<?php

use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $benefit_data = [
            [
                'id' => 1,
                'name_ar' => 'مصر',
                'name_en' => 'Egypt',
                'country_code' => '+20',
            ],
            [
                'id' => 2,
                'name_ar' => 'السعودية',
                'name_en' => 'Saudi Arabia',
                'country_code' => '+966',
            ],
            [
                'id' => 3,
                'name_ar' => 'الكويت',
                'name_en' => 'Kuwait',
                'country_code' => '+965',
            ],
            [
                'id' => 4,
                'name_ar' => 'قطر',
                'name_en' => 'Qatar',
                'country_code' => '+974',
            ],
        ];
        foreach ($benefit_data as $get) {
            City::updateOrCreate($get);
        }

    }
}
