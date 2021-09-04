<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $guarded = [];

    public function ServicesDetail()
    {
        return $this->hasMany(Service_details::class);
    }

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/services') . '/' . $img;
        else
            return asset('/uploads/users_images/default_service.jpg') ;
    }

}

