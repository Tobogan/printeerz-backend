<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_local_download;
use App\Product;
use App\Events_products;
use App\Events_customs;
use App\Customer;
use App\Printzones;
use App\Products_variants;

use File;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EventLocalDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        if ($request->ajax()) {
            $event_local_download = New Event_local_download;
            // DB requests
            $event = Event::find($request->eventId);
            $customer = Customer::find($event->customer_id);
            $events_products = Events_products::where('event_id','=',$event->id)->get();
            $events_customs = Events_customs::where('event_id','=',$event->id)->get();
            // Mains Data
            $event_local_download->eventTitle = $event->name;
            $event_local_download->eventId = $event->id;
            $event_local_download->eventCoverImg = $event->coverImgUrl;
            $event_local_download->eventLogoUrl = $event->logoUrl;
            $event_local_download->advertiserName = $event->advertiser;
            $event_local_download->customerName = $customer->title;
            $event_local_download->contactFullName = $customer->contact_person["firstname"].' '.$customer->contact_person["lastname"];
            $event_local_download->contactPhone = $customer->contact_person["phone"];
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
                            'printzones' => $products_variant->printzones,
                            'quantity' => $variant[1]
                        );
                        array_push($productsVariantsArray, $productsVariantData);
                    }
                }
                // Final JSON
                    $eventLocalDownloadProduct = array(
                        'id' => $events_product->id,
                        'title' => $events_product->title,
                        'gender' => $product->gender,
                        'type' => $product->product_type,
                        'printzones' => $printzonesArray,
                        'products_variants' => $productsVariantsArray,
                        'events_customs' => $events_customs_final
                    );
                array_push($eventLocalDownloadProducts, $eventLocalDownloadProduct);
            }
            $event_local_download->products = $eventLocalDownloadProducts;
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
                'msg' => 'You have store the future data for this event'
            );
            return response()->json($response);
        }
        else {
            return 'Error, bad request dude...:(';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event_local_download = Event_local_download::find($id);
        return view('admin/EventLocalDownload.show', [
            'event_local_download' => $event_local_download
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download_file($fileUrl, $fileName, $filePath)
    {
        $path= public_path().'/uploads'.$filePath;

        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $disk = Storage::disk('s3');
        $stream = $disk
            ->getDriver()
            ->readStream($fileUrl);
        \is_resource($stream) && \file_put_contents($path.$fileName, \stream_get_contents($stream), FILE_APPEND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id) {
        $event = Event::find($event_id);
        $event->status = "draft";
        $event_local_downloads = Event_local_download::where('eventId','=',$event_id)->get();
        $event->update();
        if ($event_local_downloads !== null) {
            foreach($event_local_downloads as $event_local_download) {
                $event_local_download->delete();
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'The event is not ready now.',
            'event_local_downloads' => $event_local_downloads
        );
        return response()->json($response);
    }
}
