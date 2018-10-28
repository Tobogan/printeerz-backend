<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'message', 'event_id','user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }
}
