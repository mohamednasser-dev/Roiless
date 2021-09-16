<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title_ar'  => ' عقاري',
            'title_en'  => 'Estate',
            'type'  => 'cat',
        ]);
    }
}
