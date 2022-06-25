<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentOrder extends Model
{
    protected $guarded = [];
    protected $appends = ['status_text','profites_text'];

    public function Images()
    {
        return $this->hasMany(InvestmentImages::class, 'investment_order_id', 'id');
    }

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Investments()
    {
        return $this->belongsTo(Investment::class, 'investment_id', 'id');
    }



    public function getStatusTextAttribute()
    {
        if ($this->status == 'pinding') {
            return 'جاري';
        } elseif ($this->status == 'rejected') {
            return 'مرفوض';
        } elseif ($this->status == 'accepted') {
            return 'تم الموافقة';
        } elseif ($this->status == 'return') {
            return 'تم التحويل لموظف اخر';
        }
    }

    public function getProfitesTextAttribute()
    {
        if ($this->profites == "1") {
            return 'شهري';
        } elseif ($this->profites == "3") {
            return 'ربع سنوي';
        } elseif ($this->profites == "6") {
            return 'نصف سنوي';
        } elseif ($this->profites == "12") {
            return 'سنوي';
        }
    }

}
