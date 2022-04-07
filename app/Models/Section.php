<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];
    protected $appends = ['title'];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/section') . '/' . $img;
        else
            return asset('/uploads/category/default.jpg') ;
    }


    public function getTitleAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }
}
