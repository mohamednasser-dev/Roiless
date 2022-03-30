<?php

use Illuminate\Database\Seeder;
use App\Models\Benefit;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name_ar' => '6 شهور',
                'name_en' => '6 months',
                'monthes_count' => '6',
            ], [
                'id' => 2,
                'name_ar' => '12 شهر',
                'name_en' => '12 months',
                'monthes_count' => '12',
            ], [
                'id' => 3,
                'name_ar' => '18 شهر',
                'name_en' => '18 months',
                'monthes_count' => '18',
            ], [
                'id' => 4,
                'name_ar' => '24 شهر',
                'name_en' => '24 months',
                'monthes_count' => '24',
            ],

        ];
        foreach ($data as $get) {
            Benefit::updateOrCreate($get);
        }
    }
}
