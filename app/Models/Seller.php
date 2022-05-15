<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;
    protected $hidden = ['password','created_at','updated_at'];
    protected $guarded = [];
    protected $appends = ['image_path','product_count'];

    public function getImagePathAttribute($image)
    {
        if (!empty($this->image)) {
            return asset('uploads/sellers') . '/' . $this->image;
        }
        return asset('uploads/sellers/default-seller.jpg');
    }

    public function getProductCountAttribute()
    {
        $count = $this->Products->count();
        return $count;
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    public function Products()
    {
        return $this->hasMany(Product::class,'section_id')->where('status','accepted');
    }
}
