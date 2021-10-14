<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    protected $appends = [ 'seen'];
    public function user(){
        return $this->belongsToMany('App\Models\User' ,'user_notifications','notification_id', 'user_id','id','id');
    }


    public function UnSeenReply()
    {
        return $this->hasMany('App\Models\User_Notification','notification_id','id')->where('user_id',Auth::user()->id)->where('seen','0');
    }
    public function getseenAttribute()
    {

            return count( $this->UnSeenReply); 
    }

    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/notification') . '/' . $img;
        else
            return asset('/uploads/notification/default.png') ;
    }

}
