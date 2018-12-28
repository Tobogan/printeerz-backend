<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Taille extends Model
{
    protected $fillable = [
        'nom'
    ];
        /*~~~~~~~~~~~_____Relation Many to Many avec les produits____~~~~~~~~~~~~*/

        public function products() {
            return $this->belongsToMany('App\Product');
        }

        public function productVariants() {
            return $this->belongsToMany('App\ProductVariants');
        }
}
