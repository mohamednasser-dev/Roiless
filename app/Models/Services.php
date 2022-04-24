<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $guarded = [];
    protected $appends = ['descar','descen'];
    public function Services()
    {
        return $this->hasMany(Service_details::class);
    }
    public function getDescarAttribute()
    {

        return $this->Services();

    }
    public function getDescenAttribute()
    {

        return $this->Services();

    }

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/services') . '/' . $img;
        else
            return asset('/uploads/services/default.png') ;
    }

}

