<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    //
    public function Consolution()
    {
        return $this->belongsTo('App\Models\Consolution','consolution_id');
    }
}
