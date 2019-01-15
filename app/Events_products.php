<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Events_products extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'events_products';

    protected $fillable = [
        'id','product_id','title','price','description','variants[]','customs[]','position','is_active', 'is_delected', 'created_at', 'updated_at'
    ];
}
