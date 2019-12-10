<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Printzones extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'printzones';

    protected $fillable = [
        'id',
        'name',
        'zone',
        'description',
        'size[]',
        'product_position[]',
        'tray[]',
        'printer_id',
        'is_active',
        'is_delected',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
