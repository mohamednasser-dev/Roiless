<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInstallment extends Model
{
    protected $guarded = [];
    protected $appends = ['status_name'];

    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        if ($this->status == 'pending') {
            return trans('admin.not_collected');
        } elseif ($this->status == 'collected') {
            return trans('admin.collected');;
        }
    }

    public function scopeSeller($query)
    {
        $seller_id = auth()->guard('seller')->user()->id;
        $query->whereHas('Order', function ($q) use ($seller_id) {
            $q->whereHas('Product', function ($q) use ($seller_id) {
                $q->where('seller_id', $seller_id);
            });
        });
    }

    public function scopeAccepted($query)
    {
        $query->whereHas('Order', function ($q) {
            $q->where('status', 'accepted');
        });
    }

}
