<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'todo';
    
    protected $fillable = [
          'name',
          'photo',
          'about',
          'contact',
          'region',
          'address'
    ];
    
    public static $region = ["Region I" => "Region I", "Region II" => "Region II", "Region III" => "Region III", "Region IV" => "Region IV", "Region IX" => "Region IX", "Region V" => "Region V", "Region VI" => "Region VI", "Region VII" => "Region VII", "Region VIII" => "Region VIII", "Region X" => "Region X", "Region XI" => "Region XI", "Region XII" => "Region XII", "Region XIII" => "Region XIII", "Region XIV" => "Region XIV", "Region XV" => "Region XV", "Region XVI" => "Region XVI", "Region XVII" => "Region XVII"];


    public static function boot()
    {
        parent::boot();

        Todo::observe(new UserActionsObserver);
    }
    
    
    
    
}