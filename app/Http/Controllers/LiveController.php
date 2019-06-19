<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Events_products;
use App\Printzones;
use App\Customer;
use App\Events_customs;
use App\Product;
use App\Products_variants;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = User::all();
        return $users->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
        $user = User::find($id);
        return $user->toJson();
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function event_local_store($id) {
        $event_local_download = New Event_local_download;
        // DB requests
        $event = Event::find($id);
        $customer = Customer::find($event->customer_id);
        $events_products = Events_products::where('event_id','=',$event->id)->get();
        $events_customs = Events_customs::where('event_id','=',$event->id)->get();
        // Mains Data
        $event_local_download->title = $event->name;
        $event_local_download->status = $event->status;
        $event_local_download->eventId = $event->id;
        $event_local_download->coverUrl = $event->coverImgUrl;
        $event_local_download->coverThumbUrl = $event->coverThumbUrl;
        $event_local_download->logoUrl = $event->logoUrl;
        $event_local_download->advertiser = $event->advertiser;
        $event_local_download->customer = array(
            'title' => $customer->title,
            'contact' => array(
                'fullname' => $customer->contact_person["firstname"].' '.$customer->contact_person["lastname"],
                'phone' => $customer->contact_person["phone"]
            ),
        );
        $event_local_download->productsCount = count($events_products);
        // Instance empty array for loop
        $productsVariantsArray = array();
        $printzonesArray = array();
        $finalProducts = array();
        $eventLocalDownloadProducts = array();
        $events_customs_final = array();
        // Printzones & products variant image by printzone
        foreach ($events_products as $events_product) {
            $events_customsArray = array();
            $productsVariantsArray = array();
            $printzonesArray = array();
            $finalProducts = array();
            $product = Product::find($events_product->product_id);
            foreach ($product->printzones_id as $printzone_id) {
                $printzone = Printzones::find($printzone_id);
                    $printzoneData = array(
                        'id' => $printzone->id,
                        'title' => $printzone->name,
                        'zone' => $printzone->zone,
                        'width' => $printzone->width,
                        'height' => $printzone->height,
                        'origin_x' => $printzone->origin_x,
                        'origin_y' => $printzone->origin_y,
                        'tray_width' => $printzone->tray_width,
                        'tray_height' => $printzone->tray_height
                    );
                    array_push($printzonesArray, $printzoneData);
            }
            // Events customs
            foreach ($events_product->event_customs_ids as $events_custom_id) {
                $events_custom = Events_customs::find($events_custom_id);
                if ($events_custom !== null) {
                    foreach ($events_custom->components as $component) {
                        $events_customsArray = array();
                        array_push($events_customsArray, $component);
                    }
                }
                $events_customs_reformed = array(
                    'title' => $events_custom->title,
                    'template_title' => $events_custom->template_title,
                    'components' => $events_customsArray
                );
                array_push($events_customs_final, $events_customs_reformed);
            }
            // Products_variants
            foreach ($events_product->variants as $variant) {
                $products_variant = Products_variants::find($variant[0]);
                if ($products_variant !== null) {
                    $productsVariantData = array(
                        'size' => $products_variant->size,
                        'color' => $products_variant->color,
                        'image' => $products_variant->image,
                        'quantity' => $variant[1],
                        'printzones' => $products_variant->printzones
                    );
                    array_push($productsVariantsArray, $productsVariantData);
                }
            }
            // Final JSON
            $eventLocalDownloadProduct = array(
                'id' => $events_product->id,
                'title' => $events_product->title,
                'image' => $product->image,
                'gender' => $product->gender,
                'type' => $product->product_type,
                'printzones' => $printzonesArray,
                'products_variants' => $productsVariantsArray,
                'events_customs' => $events_customs_final
            );
        array_push($eventLocalDownloadProducts, $eventLocalDownloadProduct);
        }
        $event_local_download->products = $eventLocalDownloadProducts;
        // the event is now ready
        $event->status = "ready";
        $locals = Event_local_download::where('eventId','=',$event->id)->get();
        foreach ($locals as $local) {
            $local->delete();
        }
        $event->update();
        $event_local_download->save();
        $event->event_local_download_id = $event_local_download->id;
        $event->update();
        $response = array(
            'status' => 'success',
            'msg' => 'You have created data for this event'
        );
        return response()->json($event_local_download);
    }
}
