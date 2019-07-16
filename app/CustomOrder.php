<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CustomOrder extends Eloquent
{
     protected $connection = 'mongodb';
    protected $collection = 'customOrder';
    protected $fillable = [
        'id', 'orderId', 'eventCustomId', 'orderNumber', 'components[]', 'currentOrderId', 'size', 'inputText', 'eventId', 'font', 'fontColor','created_at', 'updated_at'
    ];
}
