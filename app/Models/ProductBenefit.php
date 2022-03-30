<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBenefit extends Model
{
    protected $guarded = [];

    public function Benefit()
    {
        return $this->belongsTo(Benefit::class, 'benefit_id', 'id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
