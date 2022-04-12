<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [] ;

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id','id')->with(['Seller','Section','SubSection']);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
