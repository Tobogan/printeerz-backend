<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Templates extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'templates';

    protected $fillable = [
        'id','title','category','image[]','size[]','origin[]','components_ids[]','is_active','is_delected','created_at','updated_at'
    ];
}
