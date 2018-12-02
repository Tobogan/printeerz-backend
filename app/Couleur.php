<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductVariants;

class Couleur extends Model
{
    protected $fillable = [
        'nom', 'pantoneName'
    ];

    public function product() {
        return $this->belongsToMany('App\ProductVariants');
    }
}