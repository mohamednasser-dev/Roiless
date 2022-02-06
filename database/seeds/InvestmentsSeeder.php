<?php

use App\Models\Investment;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investment::Create([
            'name_en'=>'deposit Investment',
            'name_ar'=>'استثمار ودائع',
            'value'=>'10'
        ]);
        Investment::Create([
            'name_en'=>'certificate Investment',
            'name_ar'=>'استثمار شهادة',
            'value'=>'10'
        ]);
        Investment::Create([
            'name_en'=>'Market Investment',
            'name_ar'=>'استثمار بورصه',
            'value'=>'15'
        ]);
        Investment::Create([
            'name_en'=>'direct Investment',
            'name_ar'=>'استثمار مباشر',
            'value'=>'25'
        ]);
    }
}
