<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Events_customs extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'events_customs';

    protected $fillable = [
        'id', 'event_product_ids[]','events_product_variants_ids[]','title','position[]','template[]','thumb','image','comments','is_active', 'is_delected', 'created_at', 'updated_at'
    ];
}
