<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Notification extends Model
{
    //
    protected $guarded = [];    
    protected $table="user_notifications";
    public function notifications()
    {
        return $this->belongsTo(Notification::class,'notification_id');
    }
}
