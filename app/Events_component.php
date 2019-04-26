<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Events_component extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'events_component';

    protected $fillable = [
        'id', 'template_component_id','title','type','image','event_id','events_product_id','template_id','printzone_id','font_first_letter','input_min','input_max','width','height','origin_x','origin_y','fonts[]','font_colors[]','image_name','image_url','is_active', 'is_delected', 'created_at', 'updated_at'
    ];
}
