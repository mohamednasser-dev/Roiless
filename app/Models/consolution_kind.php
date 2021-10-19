<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class consolution_kind extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function Consolution()
    {
          return $this->hasOne('App\Models\Consolution','consolution_kind_id');
    }
}
