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
use App\CustomOrder;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer($id)
    {
        $customer = Customer::find($id);
        return $customer->toJson();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customs($id)
    {
        $event = Event::find($id);
        $events_customs = Events_customs::where('event_id','=',$event->id)->get();
        return $events_customs->toJson();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sizes($id)
    {
        $event = Event::find($id);
        $array = [];
        foreach ($event->event_products_id as $events_product_id) {
            $sizes = [];
            $events_product = Events_products::find($events_product_id);
            foreach ($events_product->variants as $variant) {
                $products_variant = Products_variants::find($variant[0]);
                if ($products_variant['size'] !==  null)
                array_push($sizes, $products_variant['size']);
            }
            $arr_sizes = array(
                'events_product_id' => $events_product_id,
                'sizes' => array_unique($sizes, SORT_REGULAR)
            );
            array_push($array, $arr_sizes);
        }
        return $array;
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
        $event_local_download->title = $event->title;
        $event_local_download->status = $event->status;
        $event_local_download->eventId = $event->id;
        $event_local_download->startDate = $event->start_datetime;
        $event_local_download->endDate = $event->end_datetime;
        $event_local_download->coverUrl = $event->coverUrl;
        $event_local_download->coverThumbUrl = $event->coverThumbUrl;
        $event_local_download->logoUrl = $event->logoUrl;
        $event_local_download->advertiser = $event->advertiser;
        $event_local_download->description = $event->description;
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
        // Printzones & products variant image by printzone
        foreach ($events_products as $events_product) {
            $events_customsArray = array();
            $productsVariantsArray = array();
            $printzonesArray = array();
            $finalProducts = array();
            $events_customs_final = array();
            $events_customs_reformed = array();
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
                    $events_customsArray = array();
                    foreach ($events_custom->components as $component) {
                        array_push($events_customsArray, $component);
                    }
                }
                $zone = Printzones::find($events_custom->printzone_id);
                $events_customs_reformed = array(
                    'id' => $events_custom->id,
                    'events_product_id' => $events_product->id,
                    'title' => $events_custom->title,
                    'template_title' => $events_custom->template_title,
                    'printzone_id' => $events_custom->printzone_id,
                    'printzone_title' => $printzone->name,
                    'zone' => $printzone->zone,
                    'printzone_width' => $printzone->width,
                    'printzone_height' => $printzone->height,
                    'printzone_origin_x' => $printzone->origin_x,
                    'printzone_origin_y' => $printzone->origin_y,
                    'printzone_tray_width' => $printzone->tray_width,
                    'printzone_tray_height' => $printzone->tray_height,
                    'image' => $events_custom->imageUrl,
                    'components' => $events_customsArray
                );
                array_push($events_customs_final, $events_customs_reformed);
            }
            // Products_variants
            $sizes = [];
            foreach ($events_product->variants as $variant) {
                $products_variant = Products_variants::find($variant['products_variant_id']);
                if ($products_variant !== null) {
                    $productsVariantData = array(
                        'size' => $products_variant->size,
                        'color' => $products_variant->color,
                        'image' => $products_variant->image,
                        'quantity' => $variant['quantity'],
                        'printzones' => $products_variant->printzones
                    );
                    array_push($productsVariantsArray, $productsVariantData);
                    array_push($sizes, $products_variant->size);
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
                'sizes' => $sizes,
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function event_global($event_id) {
        // DB requests
        $event = Event::find($event_id);
        $customer = Customer::find($event->customer_id);
        $events_products = Events_products::where('event_id','=',$event_id)->get();
        $events_customs = Events_customs::where('event_id','=',$event_id)->get();
        // Instance empty array for loop
        $productsVariantsArray = array();
        $printzonesArray = array();
        $finalProducts = array();
        $eventLocalDownloadProducts = array();
        // Printzones & products variant image by printzone
        foreach ($events_products as $events_product) {
            $events_customsArray = array();
            $productsVariantsArray = array();
            $printzonesArray = array();
            $finalProducts = array();
            $events_customs_final = array();
            $events_customs_reformed = array();
            $product = Product::find($events_product->product_id);
            foreach ($product->printzones_id as $printzone_id) {
                $printzone = Printzones::find($printzone_id);
                    array_push($printzonesArray, $printzone);
            }
            // Events customs
            foreach ($events_product->event_customs_ids as $events_custom_id) {
                $events_custom = Events_customs::find($events_custom_id);

                if ($events_custom !== null) {
                    $events_customsArray = array();
                    foreach ($events_custom->template['components'] as $component) {
                        array_push($events_customsArray, $component);
                    }
                }
                $zone = Printzones::find($events_custom->printzone_id);
                $events_customs_reformed = array(
                    'id' => $events_custom->id,
                    'product_id' => $events_product->product_id,
                    'title' => $events_custom->title,
                    'templates' => [
                        'id' => $events_custom->template_id,
                        'title' => $events_custom->template['title']
                    ],
                    'zone' => $printzone->zone,
                    'image' => $events_custom->imageUrl,
                    'components' => $events_customsArray
                );
                array_push($events_customs_final, $events_customs_reformed);
            }
            // Products_variants
            $sizes = [];
            foreach ($events_product->variants as $variant) {
                $products_variant = Products_variants::find($variant['products_variant_id']);
                if ($products_variant !== null) {
                    $productsVariantData = array(
                        'id' => $products_variant->id,
                        'size' => $products_variant->size,
                        'color' => $products_variant->color,
                        'quantity' => $variant['quantity'],
                        'image' => $products_variant->image
                    );
                    array_push($productsVariantsArray, $productsVariantData);
                    array_push($sizes, $products_variant->size);
                }
            }
            // Final events_custom JSON
            $eventLocalDownloadProduct = array(
                'id' => $events_product->id,
                'original_product_id' => $events_product->product_id,
                'title' => $events_product->title,
                'gender' => $product->gender,
                'type' => $product->product_type,
                'printzones' => $printzonesArray,
                'products_variants' => $productsVariantsArray,
                'sizes' => $sizes,
                'events_customs' => $events_customs_final
            );
        array_push($eventLocalDownloadProducts, $eventLocalDownloadProduct);
        }
        $global_event = [
            '_id' => $event->id,
            'title' => $event->title,
            'advertiser' => $event->advertiser,
            'customer_id' => $customer->id,
            'type' => $event->type,
            'status' => $event->status,
            'location' => [
                'address' => $event->location['address'],
                'postal_code' => $event->location['postal_code'],
                'city' => $event->location['city'],
                'country' => $event->location['country'],
                'longitude' => $event->location['longitude'],
                'lattitude' => $event->location['lattitude']
            ],
            'schedule' => [
                'start_date' => $event->start_datetime,
                'start_time' => $event->start_time,
                'end_time' => $event->end_datetime,
            ],
            'images' => [
                'cover' => [
                    'url' => $event->images['cover']['url'],
                    'thumb_url' => $event->images['cover']['thumb_url']
                ],
                'logo' => [
                    'url' => $event->images['logo']['url']
                ]
            ],
            'files' => [
                'bat' => [
                    'url' => $event->files['bat']['url']
                ]
            ],
            'products' => $eventLocalDownloadProducts,
            'description' => $event->description,
            'users' => $event->user_ids,
            'created_by' => $event->created_by,
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at
        ];

        return response()->json($global_event);
    }

    // public function refresh()
    //     {
    //         if ($token = $this->guard()->refresh()) {
    //             return response()
    //                 ->json(['status' => 'successs'], 200)
    //                 ->header('Authorization', $token);
    //         }

    //         return response()->json(['error' => 'refresh_token_error'], 401);
    //     }   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function event_synchro(Request $request) {
        $orders = $request->all();
        // For each orders stored on browser create a new Custom Order
        if ($orders !== null) {
            foreach ($orders as $ord) {
                if ($ord) {
                    foreach ($ord as $order) {
                        if ($order) {
                            $customOrder = new CustomOrder;
                            $customOrder->orderId  = $order['id'];
                            $customOrder->orderNumber  = $order['orderNumber'];
                            $customOrder->currentOrderId  = $order['currentOrderId'];
                            $customOrder->eventCustomId  = $order['eventCustomId'];
                            $customOrder->components  = $order['components'];
                            $customOrder->eventId  = $order['eventId'];
                            $customOrder->inputText  = $order['inputTexts'];
                            $customOrder->size  = $order['size'];
                            $customOrder->font  = $order['fonts'];
                            $customOrder->fontColor  = $order['fontColors'];
                            $customOrder->save();
                            $event = Event::find($order['eventId']);
                            $event->status = 'done';
                            $event->update();
                        }
                    }
                }
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Synchro: success !'
        );
        return response()->json($response);
    }

    /**
     * Update event status
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id, $status) {
        $event = Event::find($id);
        $event->status = $status;
        $event->update();
        $response = array(
            'status' => 'success',
            'msg' => 'Event status updated'
        );
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function downloadS3File(Request $request)
    {
        $cleanUrl = substr($request->url, 1);
        $file = Storage::disk('s3')->url($cleanUrl);
        header("Cache-Control: public");
        header('Access-Control-Allow-Origin:*');
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($request->url));
        header("Content-Type:" . $request->type);
        return readfile($file);
    }
   
    /**
     * Update event status
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEventStatus($id) {
        $event = Event::find($id);
        return $event->status;
    }
}