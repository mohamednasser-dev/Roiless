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
        return $this->hasMany('App\Models\Fund','cat_id')
            ->select('id','name_ar','name_en','image','cat_id','desc_ar','desc_en')
            ->where('appearance', '1')->where('deleted','0');
    }
    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/category') . '/' . $img;
        else
            return asset('/uploads/category/default.jpg') ;
    }
}
