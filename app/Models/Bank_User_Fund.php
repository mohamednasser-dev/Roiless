<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank_User_Fund extends Model
{
    protected $guarded;

    public function Bank()
    {
        return $this->belongsTo('App\Models\Bank','bank_id');
    }

}
