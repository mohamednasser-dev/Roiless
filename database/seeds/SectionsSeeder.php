<?php

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsSeeder extends Seeder
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
