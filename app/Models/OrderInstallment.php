<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInstallment extends Model
{
    protected $guarded = [] ;

    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }

}
