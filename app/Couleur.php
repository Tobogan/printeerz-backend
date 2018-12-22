<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Productvariants;

class Couleur extends Model
{
    protected $fillable = [
        'nom', 'pantoneName'
    ];

    public function product() {
        return $this->belongsToMany('App\Productvariants');
    }
}