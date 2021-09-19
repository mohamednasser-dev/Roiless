<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bank extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'banks';
    protected $guarded = [];

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'bank_id', 'notification_id', 'id', 'id');
    }

    public function funds()
    {
        return $this->belongsTo('App\Models\Bank_Fund', 'bank_id', 'id');
    }
}


