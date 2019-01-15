<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Products_variants extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products_variants';

    protected $fillable = [
        'id','name','product_id','color','size','quantity','vendor[]','image','position','product_zones[]','is_active','is_delected','created_at','updated_at'
    ];
}
