<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Location extends Model {

    

    

    protected $table    = 'location';
    
    protected $fillable = [
          'name',
          'description'
    ];
    

    public static function boot()
    {
        parent::boot();

        Location::observe(new UserActionsObserver);
    }
    
    
    
    
}