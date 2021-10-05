<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consolution extends Model
{
    //
    public function consolution_kind()
    {
        return $this->belongsTo('App\Models\consolution_kind','consolution_kind_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\users','user_id');
    }
    public function reply()
    {
        return $this->hasMany('reply','Consolution_id','id');
    }
    public function Admin()
    {
        return $this->belongsTo('Admin','admin_id','id');
    }

}
