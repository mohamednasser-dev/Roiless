<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use softdeletes;

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
            return asset('/uploads/users_images/default_avatar.jpg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'user_id', 'notification_id', 'id', 'id');
    }
}
