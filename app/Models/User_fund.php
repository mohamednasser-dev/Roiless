<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class User_fund extends Model
{
    protected $guarded = [];

    protected $appends = ['user_status_text','payment_text'];
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

    public function Banks_sent()
    {
        return $this->hasMany(Bank_User_Fund::class, 'user_fund_id');
    }

    public function ُEmployer()
    {
        return $this->belongsTo(Admin::class, 'emp_id');
    }

    public function Banks()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function Selected_Bank()
    {
        return $this->belongsTo(Bank::class, 'user_bank_id');
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
        return $this->belongsTo(User::class, 'user_id')->select('id','name','phone');
    }
    public function getUserStatusTextAttribute()
    {
        if ($this->user_status == 'pending') {
            return 'جاري';
        } elseif ($this->user_status == 'rejected') {
            return 'مرفوض';
        } elseif ($this->user_status == 'user_editing') {
            return 'تم التعديل من جهة المستخدم';
        } elseif ($this->user_status == 'payed') {
            return 'مدفوع';
        } elseif ($this->user_status == 'payed_success') {
            return 'الدفع مقبول';
        }elseif ($this->user_status == 'payed_rejected') {
            return 'الدفع مرفوض';
        }elseif ($this->user_status == 'payed_success') {
            return 'مدفوع';
        }elseif ($this->user_status == 'payed_success') {
            return 'مدفوع';
        }elseif ($this->user_status == 'finail_accept') {
            return 'مقبول نهائيا';
        }elseif ($this->user_status == 'finail_rejected') {
            return 'مرفوض نهائيا';
        }
    }
    public function getPaymentTextAttribute()
    {
        if ($this->payment == 'paid') {
            return 'مدفوع';
        } elseif ($this->payment == 'not paid') {
            return 'غير مدفوع';
        }
    }



}
