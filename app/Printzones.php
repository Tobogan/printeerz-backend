<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Printzones extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'printzones';

    protected $fillable = [
        'id','name','printer_id','zone','width','height','origin_x','origin_y','tray_width','tray_height','description','is_active','is_delected','created_at','updated_at'
    ];
}
