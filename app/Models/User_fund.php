<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_fund extends Model
{
    protected $guarded = [];

    public function Fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }


    public function Files()
    {
        return $this->hasMany(Fund_file::class, 'user_fund_id');
    }

    public function ُEmployer()
    {
        return $this->belongsTo(Admin::class, 'emp_id');
    }

    public function fund_file()
    {
        return $this->hasOne('App\Models\Fund_file', 'user_fund_id');
    }
}
