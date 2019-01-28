<?php

namespace App;

use App\Event;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'customers';
    protected $fillable = [
        'id', 'title', 'activity_type', 'SIREN', 'location[]', 'contact_person[]', 'events_id[]', 'image', 'comments', 'is_active', 'is_deleted', 'created_at', 'updated_at'
    ];

    public function events() {
        return $this->hasMany('App\Event');
    }

    /*public function getEventsListAttribute(){
        if($this->id){
            return $this->events->pluck('id');
        }            
    }

    public function setEventsListAttribute($value){
        return $this->events()->sync($value);
    }*/
}