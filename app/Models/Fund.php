<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fund extends Model
{
    use softdeletes;

    protected $guarded = [];
    protected $date = ['delete_at'];
//    protected $hidden = ['cat_id'];

    public function Category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }



    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/funds') . '/' . $img;

    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User','User_fund','Fund_id','User_id','id','id');
    }

}
