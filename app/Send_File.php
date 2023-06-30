<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Send_File extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'orders_uploads';

    protected $fillable = [
        'id',
        'orderId',
        'event_id',
        'events_custom_id',
        'img',
    ];
}