<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Agencu extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'agencu';

    protected $fillable = [
          'photo',
          'name',
          'price',
          'location',
          'coverage',
          'user_id',
          'package_type',
          'partner_id',
          'days'
    ];


    public static function boot()
    {
        parent::boot();

        Agencu::observe(new UserActionsObserver);
    }




}
