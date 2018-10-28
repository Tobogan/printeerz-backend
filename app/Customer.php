<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Customer extends Model
{
    protected $fillable = [
        'denomination', 'adresse', 'code_postal', 'ville', 'siren', 'activite', 'event_id', 'nb_events', 'nb_impression', 'informations', 'contact_nom', 'contact_prenom', 'contact_email', 'contact_email', 'contact_telephone', 'contact_poste'
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
