<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_fund extends Model
{
    protected $guarded=[];

    public function userfunds()
    {
        return $this->belongsTo(Fund::class,'fund_id');
    }
}
