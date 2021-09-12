<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use softdeletes;

    protected $guarded = [];
    protected $date = ['delete_at'];

    public function category()
    {
        return $this->belongsTo(category::class,'cat_id');
    }


}
