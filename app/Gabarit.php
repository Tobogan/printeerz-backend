<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gabarit extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}