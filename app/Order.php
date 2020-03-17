<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'order';

    protected $fillable = [
        'id', 
        'title', 
        'is_active', 
        'is_delected', 
        'created_at', 
        'updated_at'
    ];
}