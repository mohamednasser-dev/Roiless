<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    //
    protected $guarded = [];
    public function Consolution()
    {
        return $this->belongsTo('App\Models\Consolution','consolution_id');
    }
    public function Admin()
    {
        return $this->belongsTo('App\Models\Admin','admin_id','id');
    }
   
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
