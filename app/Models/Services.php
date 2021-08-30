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

}

