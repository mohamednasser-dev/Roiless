<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image',
        'type',
        't_ids'
    ];

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/slider') . '/' . $img;

    }

}
