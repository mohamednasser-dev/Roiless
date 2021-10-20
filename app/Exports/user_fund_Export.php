<?php

namespace App\Exports;

use App\Models\User_fund;
use Maatwebsite\Excel\Concerns\FromCollection;

class user_fund_Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User_fund::all();
    }
}
