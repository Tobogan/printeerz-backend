<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events_products;
use App\Printzones;
use App\Events_customs;
use App\Product;
use App\Event_local_download;

use Illuminate\Http\Request;

class LiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        $events = Event::where('status','!=','draft')->get();
        return $events->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventsProducts()
    {
        $events_products = Events_products::all();
        return $events_products->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function event($id)
    {
        $event = Event::find($id);
        return $event->toJson();
    }

    /**
     * Display the specified resource.
     * Return array of events_product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eventsProductIds($id)
    {
        $event = Event::find($id);
        $events_products_ids = $event->event_products_id;
        return $events_products_ids;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eventsProduct($id)
    {
        $events_product = Events_products::find($id);
        return $events_product->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printzone($id)
    {
        $printzone = Printzones::find($id);
        return $printzone->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printzones()
    {
        $printzones = Printzones::all();
        return $printzones->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function events_custom($id)
    {
        $events_custom = Events_customs::find($id);
        return $events_custom->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events_customs()
    {
        $events_customs = Events_customs::all();
        return $events_customs->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product($id)
    {
        $product = Product::find($id);
        return $product->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $products = Product::all();
        return $products->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function event_local_download($id)
    {
        $event_local_download = Event_local_download::find($id);
        return $event_local_download->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloaded($id)
    {
        $event = Event::find($id);
        $event->status = "ready";
        $event->update();
        return $event->toJson();
    }
}
