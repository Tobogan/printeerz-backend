<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\ProductVariants;
use App\Event;

class EventVariants extends Model
{
    protected $fillable = [
        'product_id', 'event_id', 'productVariants_id', 'variant_id'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function productVariants() {
        return $this->belongsToMany('App\ProductVariants');
    }

    public function getProductVariantsListAttribute(){
        if($this->id){
            return $this->productVariants->pluck('id');
        }
    }

    public function setProductVariantsListAttribute($value){
        return $this->productVariants()->sync($value);
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
