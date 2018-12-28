<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Customer extends Model
{
    protected $fillable = [
        'name', 'adress', 'postal_code', 'city', 'siren', 'activity', 'event_id', 'event_qty', 'print_qty', 'informations', 'contact_lastname', 'contact_firstname', 'contact_email', 'contact_email', 'contact_phone', 'contact_job'
    ];

    public function event() {
        return $this->hasMany('App\Event');
    }

    public function getEventsListAttribute(){
        if($this->id){
            return $this->customers->pluck('id');
        }            
    }

    public function setEventsListAttribute($value){
        return $this->customers()->sync($value);
    }
}
