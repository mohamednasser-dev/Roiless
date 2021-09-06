<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class common_question extends Model
{
    protected $guarded = [];


    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/question') . '/' . $img;

    }
}
