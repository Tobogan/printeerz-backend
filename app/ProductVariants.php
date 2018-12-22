<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Couleur;
use App\Event;


class ProductVariants extends Model
{
    protected $fillable = [
        'product_id', 'couleur_id', 'zone1','zone2','zone3','zone4','zone5', 'image1','image2','image3','image4','image5'
    ];

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function couleur() {
        return $this->belongsTo('App\Couleur');
    }

    public function events() {
        return $this->belongsToMany('App\Event');
    }
}
