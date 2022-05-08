<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['type_name','status_name'];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->with(['Seller', 'Section', 'SubSection']);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeSeller($query)
    {
        $seller_id = auth()->guard('seller')->user()->id;
        $query->whereHas('Product', function ($q) use ($seller_id) {
            $q->where('seller_id', $seller_id);
        });
    }

    public function getTypeNameAttribute()
    {
        if ($this->installment_type == 'direct_installment') {
            return trans('admin.direct_installment');
        } elseif ($this->installment_type == 'not_direct_installment') {
            return trans('admin.not_direct_installment');;
        }
    }

    public function getStatusNameAttribute()
    {
        if ($this->status == 'pending') {
            return trans('admin.pending');
        } elseif ($this->status == 'accepted') {
            return trans('admin.accepted');;
        } elseif ($this->status == 'rejected') {
            return trans('admin.rejected');;
        }
    }
}
