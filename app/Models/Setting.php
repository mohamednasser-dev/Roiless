<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model

{
    protected $guarded = [];
    protected $hidden=['created_at','updated_at'];

    public function getlogoAttribute($img)
    {
        if ($img)
            return asset('/uploads/setting') . '/' . $img;
        else
            return asset('/uploads/setting/logo.png') ;
    }
}
