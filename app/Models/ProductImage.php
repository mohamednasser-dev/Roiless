<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        if (!empty($this->image)) {
            return asset('uploads/products') . '/' . $this->image;
        }
        return asset('default-image.png');
    }
}
