<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Event_local_download extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'event_local_download';

    protected $fillable = [
        '_id', 'eventTitle', 'eventCoverImg', 'eventLogoName', 'advertiserName', 'clientName', 'contactFullName', 'contactPhone', 'productsCount', 'product1[]', 'created_at', 'updated_at'
    ];
}
