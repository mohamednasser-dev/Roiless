<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Consolution extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = [ 'seen'];
    public function consolution_kind()
    {
        return $this->belongsTo('App\Models\consolution_kind','consolution_kind_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\users','user_id');
    }
    public function reply()
    {
        return $this->hasMany('App\Models\reply','Consolution_id','id');
    }
    public function UnSeenReply()
    {
        return $this->hasMany('App\Models\reply','Consolution_id','id')->where('admin_id','!=',null)->where('seen','0');
    }
    public function unseenreplies()     
    {
        return $this->hasMany('App\Models\reply','Consolution_id','id')->where('user_id','!=',null)->where('seen','0');
    }
    public function getseenAttribute()
    {
            return count( $this->UnSeenReply); 
    }
    public function Admin()
    {
        return $this->belongsTo('Admin','admin_id','id');
    }

}
