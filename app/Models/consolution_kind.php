<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class consolution_kind extends Model
{
    //

    public function Consolution()
    {
          return $this->hasOne('App\Models\Consolution','consolution_kind_id');
    }
}
