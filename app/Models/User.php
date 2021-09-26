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



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    protected $fillable = [
        'name', 'image', 'email', 'password', 'type', 'role_id', 'cat_id', 'phone'
    ];

    protected $date = ['delete_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
}
