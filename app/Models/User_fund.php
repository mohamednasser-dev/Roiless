<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class User_fund extends Model
{
    protected $guarded = [];

    public function Fund()
    {
        return $this->belongsTo(Fund::class, 'fund_id');
    }

    public function Files_img()
    {
        return $this->hasMany(Fund_file::class, 'user_fund_id')->where('file_ext','!=','pdf');
    }

    public function Files_pdf()
    {
        return $this->hasMany(Fund_file::class, 'user_fund_id')->where('file_ext','pdf');
    }

    public function ُEmployer()
    {
        return $this->belongsTo(Admin::class, 'emp_id');
    }
    public function Banks()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function fund_file()
    {
        return $this->hasOne('App\Models\Fund_file', 'user_fund_id');
    }

    public function Fund_details()
    {
        return $this->belongsTo(Fund::class, 'fund_id')->select('id','name_ar','name_en','image');
    }

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id','name');
    }


}
