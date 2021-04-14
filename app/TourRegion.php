<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourRegion extends Model
{
    //
    protected $table = "tourist_region";
    protected $fillable = [
        'user_id','region_id','tourist_id'
    ];
}
