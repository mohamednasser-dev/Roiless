<?php

use Illuminate\Database\Seeder;
use App\Models\Benefit;
use App\Models\Section;

class BenefitSeeder extends Seeder
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
                'id' => 6,
                'name_ar' => '6 شهور',
                'name_en' => '6 months',
                'months_count' => '6',
            ], [
                'id' => 12,
                'name_ar' => '12 شهر',
                'name_en' => '12 months',
                'months_count' => '12',
            ], [
                'id' => 18,
                'name_ar' => '18 شهر',
                'name_en' => '18 months',
                'months_count' => '18',
            ], [
                'id' => 24,
                'name_ar' => '24 شهر',
                'name_en' => '24 months',
                'months_count' => '24',
            ],
        ];
        foreach ($benefit_data as $get) {
            Benefit::updateOrCreate($get);
        }



        //sections
        $data = [
            [
                'title_ar' => 'الاجهزة الكهربية',
                'title_en' => 'electrical appliances',
            ],
            [
                'title_ar' => 'الاجهزة الالكترونية',
                'title_en' => 'electronic devices',
            ],
            [
                'title_ar' => 'موضة',
                'title_en' => 'fashion',
            ],
        ];
        foreach ($data as $get) {
            Section::updateOrCreate($get);
        }
        $sections = Section::where('parent_id', null)->get();
        foreach ($sections as $section) {
            $sub_data = [
                [
                    'title_ar' => 'القسم الفرعي الاول',
                    'title_en' => 'First subsection',
                    'parent_id' => $section->id,
                ],
                [
                    'title_ar' => 'القسم الفرعي الثاني',
                    'title_en' => 'Second subsection',
                    'parent_id' => $section->id,
                ],
            ];
            foreach ($sub_data as $row) {
                Section::updateOrCreate($row);
            }
        }
    }
}
