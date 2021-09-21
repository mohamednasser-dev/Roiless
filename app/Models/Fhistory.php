<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fhistory extends Model
{
    protected $guarded=[];

    public function ُEmployer()
    {
        return $this->belongsTo(Admin::class,'emp_id');
    }
    public function ُEmployerReturned()
    {
        return $this->belongsTo(Admin::class,'return_emp_id');
    }
}
