<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = "regions";
    protected $fillable = [
        'code','name','desc'
    ];
    public $timestamps = true;
}
