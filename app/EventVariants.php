<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;

class EventVariants extends Model
{
    protected $fillable = [
        'product_id', 'event_id', 'productVariants_id'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function productVariants() {
        return $this->belongsToMany('App\ProductVariants');
    }

    public function getproductVariantsListAttribute(){
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
