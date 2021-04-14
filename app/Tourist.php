<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Tourist extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'tourist';

    protected $fillable = [
          'name',
          'address',
          'website',
          'categorytags_id',
          'mostly_good',
          'user_id',
          'description',
          'photo',
          'lat',
          'lng'
    ];


    public static function boot()
    {
        parent::boot();

        Tourist::observe(new UserActionsObserver);
    }

    public function categorytags()
    {
        return $this->hasOne('App\CategoryTags', 'id', 'categorytags_id');
    }





}
