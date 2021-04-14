<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Festival extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'festival';

    protected $fillable = [
          'photo',
          'name',
          'description',
          'todo_id'
    ];


    public static function boot()
    {
        parent::boot();

        Festival::observe(new UserActionsObserver);
    }




}
