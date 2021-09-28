<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Bank extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'banks';
    protected $guarded = [];
    use LogsActivity;

    // Customize log name
    protected static $logName = 'bank';

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
            return asset('/uploads/banks_image') . '/' . $img;
        else
            return asset('/uploads/banks_image/default.png') ;
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification', 'user_notifications', 'bank_id', 'notification_id', 'id', 'id');
    }

    public function funds()
    {
        return $this->belongsTo('App\Models\Bank_Fund', 'bank_id', 'id');
    }
}


