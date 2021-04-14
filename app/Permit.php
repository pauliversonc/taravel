<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Permit extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'permit';
    
    protected $fillable = [
          'permit',
          'businesstype_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        Permit::observe(new UserActionsObserver);
    }
    
    public function businesstype()
    {
        return $this->hasOne('App\BusinessType', 'id', 'businesstype_id');
    }


    
    
    
}