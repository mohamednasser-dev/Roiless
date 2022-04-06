<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/section') . '/' . $img;
        else
            return asset('/uploads/category/default.jpg') ;
    }
}
