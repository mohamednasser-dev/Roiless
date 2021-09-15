<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    use softdeletes;
    protected $table = 'admins';
    protected $guarded = [];

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'admin_id', 'notification_id', 'id', 'id');
    }
}
