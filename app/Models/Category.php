<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded = [];


    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
