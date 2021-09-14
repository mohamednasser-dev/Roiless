<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];


    public function Users()
    {
        return $this->hasMany(User::class);
    }

    public function Funds()
    {
        return $this->hasMany(Fund::class);
    }
    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/category') . '/' . $img;

    }
}
