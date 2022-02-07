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
    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Investments()
    {
        return $this->belongsTo(Investment::class, 'investment_id', 'id');
    }

}
