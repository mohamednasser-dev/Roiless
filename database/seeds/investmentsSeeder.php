<?php

use App\Models\Investment;
use Illuminate\Database\Seeder;

class investmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investment::Create([
            'name'=>'deposit',
            'value'=>'10'
        ]);
        Investment::Create([
            'name'=>'certificate',
            'value'=>'10'
        ]);
        Investment::Create([
            'name'=>'Market',
            'value'=>'15'
        ]);
        Investment::Create([
            'name'=>'direct',
            'value'=>'25'
        ]);
    }
}
