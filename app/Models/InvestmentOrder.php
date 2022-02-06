<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentOrder extends Model
{
    protected $guarded = [];
    public function Images()
    {
        return $this->hasMany(InvestmentImages::class, 'investment_order_id', 'id');
    }
}
