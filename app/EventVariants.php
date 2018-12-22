<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\Taille;

class EventVariants extends Model
{
    protected $fillable = [
        'product_id', 'event_id', 'Productvariants_id', 'taille_id'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function Productvariants() {
        return $this->belongsToMany('App\Productvariants');
    }

    public function tailles() {
        return $this->belongsToMany('App\Taille');
    }

    public function getTaillesListAttribute(){
        if($this->id){
            return $this->tailles->pluck('id');
        }
    }

    public function setTaillesListAttribute($value){
        return $this->tailles()->sync($value);
    }

    public function getProductvariantsListAttribute(){
        if($this->id){
            return $this->Productvariants->pluck('id');
        }
    }

    public function setProductvariantsListAttribute($value){
        return $this->Productvariants()->sync($value);
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}