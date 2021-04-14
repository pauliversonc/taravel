<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionLib extends Model
{
    //
    protected $table = "region_libs";
    protected $fillable = [
        'user_id','region_id','business_profile_id'
    ];
    public $timestamps = true;
}
