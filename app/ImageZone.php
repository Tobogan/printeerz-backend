<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageZone extends Model
{
    protected $fillable = [
        'imageName'
    ];

    public function imageZone() {
        return $this->belongsTo('App\Product');
    }
}
