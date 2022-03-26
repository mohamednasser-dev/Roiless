<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute($image)
    {
        if (!empty($this->image)) {
            return asset('uploads/sellers') . '/' . $this->image;
        }
        return asset('uploads/sellers/default-seller.jpg');
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
