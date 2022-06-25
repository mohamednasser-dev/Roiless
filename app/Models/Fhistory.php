<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fhistory extends Model
{
    protected $guarded = [];
    protected $appends = ['status_text'];

    public function ُEmployer()
    {
        return $this->belongsTo(Admin::class, 'emp_id');
    }

    public function ُEmployerReturned()
    {
        return $this->belongsTo(Admin::class, 'return_emp_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == 'pending') {
            return 'جاري';
        } elseif ($this->status == 'rejected') {
            return 'مرفوض';
        } elseif ($this->status == 'accept') {
            return 'تم الموافقة';
        } elseif ($this->status == 'return') {
            return 'تم التحويل لموظف اخر';
        } elseif ($this->status == 'finail_rejected') {
            return 'مرفوض نهائيا';
        }
    }
}
