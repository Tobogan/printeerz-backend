<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\TypeEvent;
use App\Product;
use App\Comment;

class Event extends Model
{
    protected $fillable = [
        'nom', 'customer_id', 'annonceur', 'couleurs_list', 'logoName', 'imageName1', 'imageName2', 'lieu', 'date', 'type', 'contact', 'commentaire', 'product_id'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    // public function products() {
    //     return $this->belongsToMany('App\Product');
    // }

    // public function getProductListAttribute() {
    //     if($this->id){
    //         return $this->products->pluck('id');
    //     }            
    // }

    // public function setProductListAttribute($value) {
    //     return $this->products()->sync($value);
    // }

    public function typeEvents() {
        return $this->belongstoMany('App\TypeEvent');
    }

    public function getTypeEventsListAttribute() {
        if($this->id){
            return $this->typeEvents->pluck('id');
        }            
    }

    public function setTypeTypeEventsListAttribute($value) {
        return $this->typeEvents()->sync($value);
    }

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

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function getUserListAttribute() {
        if($this->id){
            return $this->users->pluck('id');
        }            
    }

    public function setUserListAttribute($value) {
        return $this->users()->sync($value);
    }

}
