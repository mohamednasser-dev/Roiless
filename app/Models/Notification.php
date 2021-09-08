<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsToMany('App\Models\User' ,'user_notifications','notification_id', 'user_id','id','id');
    }
}
