<?php

namespace App;

use App\Customer;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Event extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'events';

    protected $fillable = [
        'id', 'customer_id', 'advertiser', 'name', 'location[]', 'start_datetime', 'end_datetime', 'type', 'logo_img', 'cover_img', 'description', 'event_products_id[]', 'employees[]', 'comments[]', 'is_active', 'is_delected', 'created_at', 'updated_at'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    /*public function product() {
        return $this->belongsTo('App\Product');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    // public function productVariants() {
    //     return $this->hasMany('App\ProductVariants');
    // }



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
*/
}
