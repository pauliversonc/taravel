<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'businesstype';
    
    protected $fillable = [
          'name',
          'description'
    ];
    

    public static function boot()
    {
        parent::boot();

        BusinessType::observe(new UserActionsObserver);
    }
    
    
    
    
}