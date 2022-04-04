<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $appends = ['image_path','name'];

    public function getImagePathAttribute()
    {
        if (!empty($this->image)) {
            return asset('uploads/products') . '/' . $this->image;
        }
        return asset('default-image.png');
    }

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function Seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }
}
