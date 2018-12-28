<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Couleur;
use App\Event;
use App\Taille;


class ProductVariants extends Model
{
    protected $fillable = [
        'product_id', 'couleur_id', 'zone1','zone2','zone3','zone4', 'image1','image2','image3','image4','taille_id','event_variants_id'
    ];

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function couleur() {
        return $this->belongsTo('App\Couleur');
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function taille() {
        return $this->belongsTo('App\Taille');
    }

    public function eventVariants() {
        return $this->belongsToMany('App\EventVariants');
    }

    // public function getTaillesListAttribute(){
    //     if($this->id){
    //         return $this->tailles->pluck('id');
    //     }
    // }

    // public function setTaillesListAttribute($value){
    //     return $this->tailles()->sync($value);
    // }

}
