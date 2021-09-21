<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Authenticatable
{
    use Notifiable;
    use softdeletes;
    protected $table = 'admins';
    protected $guarded = [];

    use LogsActivity;

    // Customize log name
    protected static $logName = 'admin';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [ 'name' , 'email', 'password'];

    protected static $recordEvent = ['created_at', 'updated_at'];

    protected static $ignoreChangedAttributes = ['password' , 'updated_at'];

    protected static $logOnlyDirty = true;

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }
    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/admins_image') . '/' . $img;
        else
            return asset('/uploads/admins_image/defultAvatar.jpg') ;

    }
    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'admin_id', 'notification_id', 'id', 'id');
    }
}
