<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function getlogoAttribute($img)
    {
        if ($img)
            return asset('/uploads/setting') . '/' . $img;
        else
            return asset('/uploads/setting/logo.png') ;
    }
}
