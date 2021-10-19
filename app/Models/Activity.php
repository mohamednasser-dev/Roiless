<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatActivity;

class Activity extends SpatActivity
{
    
    public function employees() {
        return $this->belongsTo('App\Models\Admin', 'causer_id', 'id');
    }
}
