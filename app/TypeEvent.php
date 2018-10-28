<?php

namespace App;
use App\Event;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function events() {
        return $this->belongsToMany('App\Event');
    }
}