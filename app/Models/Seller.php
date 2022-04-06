<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;
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
