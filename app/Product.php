<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Couleur;
use App\Zone;
use App\Taille;
use App\Event;
use App\ImageZone;
use App\Gabarit;

class Product extends Model
{
    protected $fillable = [
        'nom', 'reference', 'sexe', 'description', 'tailles_list', 'couleurs_list', 'zones_list', 'photo_illustration'
    ];

     /*~~~~~~~~~~~_____Relation Many to Many avec les couleurs dispo____~~~~~~~~~~~~*/

    public function couleurs() {
        return $this->belongsToMany('App\Couleur');
    }

    public function getCouleursListAttribute(){
        if($this->id){
            return $this->couleurs->pluck('id');
        }
    }

    public function setCouleursListAttribute($value){
        return $this->couleurs()->sync($value);
    }

    /*~~~~~~~~~~~_____Relation Many to Many avec les zones d'impression____~~~~~~~~~~~~*/

    public function zones() {
        return $this->belongsToMany('App\Zone');
    }

    public function getZonesListAttribute(){
        if($this->id){
            return $this->zones->pluck('id');
        }            
    }

    public function setZonesListAttribute($value){
        return $this->zones()->sync($value);
    }

    public function events() {
        return $this->hasMany('App\Event');
    }
    

    public function imageZones() {
        return $this->hasMany('App\ImageZone');
    }

    public function getImageZonesListAttribute(){
        if($this->id){
            return $this->imageZones->pluck('id');
        }            
    }

    public function setImageZonesListAttribute($value){
        return $this->imageZones()->sync($value);
    }

    public function gabarits() {
        return $this->belongsToMany('App\Gabarit');
    }

    public function getGabaritsListAttribute(){
        if($this->id){
            return $this->gabarits->pluck('id');
        }            
    }

    public function setGabaritsListAttribute($value){
        return $this->gabarits()->sync($value);
    }
}