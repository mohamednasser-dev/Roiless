<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund_file extends Model
{
    //
    protected $table = 'fund_files';
    protected $guarded = [];
    protected $hidden=['created_at','updated_at'];
    public $timestamps=false;

    public function user_funds()
    {
        return $this->belongsTo('App\Models\User_fund','user_fund_id');
    }
       
}
