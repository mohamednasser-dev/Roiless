<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use softdeletes;
    protected $table='users';
    protected $date = ['delete_at'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'name', 'image', 'email', 'password', 'type', 'role_id', 'cat_id', 'phone','verified','otp_code','fcm_token','lang'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }



    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/users_images') . '/' . $img;
        else
            return asset('/uploads/users_images/default.png');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'user_id', 'notification_id', 'id', 'id');
    }
    public function Funds()
    {
        return $this->belongsToMany('App\Models\Fund','User_funds','User_id','fund_id','id','id');
    }
    public function consolutions()
    {
        return $this->hasMany('Consolution','user_id','id');
    }
    public function reply()
    {
        return $this->hasMany('\App\models\reply','user_id','id');
    }

    public function UserFunds()
    {
        return $this->hasMany(User_fund::class);
    }
}
