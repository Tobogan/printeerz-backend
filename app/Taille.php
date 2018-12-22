<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Productvariants;

class Taille extends Model
{
    protected $fillable = [
        'nom'
    ];
        /*~~~~~~~~~~~_____Relation Many to Many avec les produits____~~~~~~~~~~~~*/

        public function products() {
            return $this->belongsToMany('App\Product');
        }

        public function productvariants() {
            return $this->belongsToMany('App\Productvariants');
        }
}
