<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminhistory extends Model
{
    //
    protected $guarded;
    public function Admin()
    {
        return $this->belongsTo(Admin::class,'emp_id');
    }
}
