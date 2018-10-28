<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Zone extends Model
{
    protected $fillable = [
        'nom', 'imageName'
    ];
        /*~~~~~~~~~~~_____Relation Many to Many avec les produits____~~~~~~~~~~~~*/

        public function products() {
            return $this->belongsToMany('App\Product');
        }
}
