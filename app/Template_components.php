<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Template_components extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'template_components';

    protected $fillable = [
        'id','title','type','characters[]', 'size[]','origin[]','is_customizable','is_active','is_delected','created_at','updated_at'
    ];
}
