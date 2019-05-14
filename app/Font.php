<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Font extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'fonts';

    protected $fillable = [
        'id', 'title', 'weight', 'url', 'is_active', 'is_delected', 'created_at', 'updated_at'
    ];
}
