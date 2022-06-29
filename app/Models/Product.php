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
    public function getImageAttribute()
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

    public function SellerInfo()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id')
            ->select('id','name','phone','email','image');
    }

    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public function SubSection()
    {
        return $this->belongsTo(Section::class, 'sub_section_id', 'id');
    }

    public function Images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function Benefit()
    {
        return $this->hasMany(ProductBenefit::class, 'product_id', 'id')->with('Benefit');
    }
}
