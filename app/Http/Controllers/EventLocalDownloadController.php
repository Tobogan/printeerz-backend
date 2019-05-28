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
            $event_local_download->eventCoverImg = $event->cover_img;
            $event_local_download->eventLogoName = $event->logoName;
            $event_local_download->advertiserName = $event->advertiser;
            $event_local_download->customerName = $customer->title;
            $event_local_download->contactFullName = $customer->contact_person["firstname"].' '.$customer->contact_person["lastname"];
            $event_local_download->contactPhone = $customer->contact_person["phone"];
            $event_local_download->productsCount = count($events_products);
            // Instance empty array for loop
            $events_customsArray = array();
            $productsVariantsArray = array();
            $printzonesArray = array();
            $finalProducts = array();
            $eventLocalDownloadProducts = array();
            // Printzones & products variant image by printzone
            foreach($events_products as $events_product) {
                $events_customsArray = array();
                $productsVariantsArray = array();
                $printzonesArray = array();
                $finalProducts = array();
                $product = Product::find($events_product->product_id);
                foreach($product->printzones_id as $printzone_id) {
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
                foreach($events_product->event_customs_ids as $events_custom_id) {
                    $events_custom = Events_customs::find($events_custom_id);
                    foreach($events_custom->components as $component) {
                        if($component['component_type'] == 'image') {
                            $eventsCustomImageArray = array(
                                'title' => $events_custom->title,
                                'componentTitle' => $component['title'],
                                'componentType' => $component['component_type'],
                                'image' => $component['settings']['image_url'],
                                'width' => $component['settings']['position']['width'],
                                'height' => $component['settings']['position']['height'],
                                'origin_x' => $component['settings']['position']['origin_x'],
                                'origin_y' => $component['settings']['position']['origin_y']
                            );
                            array_push($events_customsArray, $eventsCustomImageArray);
                        }
                        else if($component['component_type'] == 'input') {
                            $eventsCustomInputArray = array(
                                'title' => $events_custom->title,
                                'componentTitle' => $component['title'],
                                'componentType' => $component['component_type'],
                                'input_min'=> $component['settings']['input_min'],
                                'input_max'=> $component['settings']['input_max'],
                                'font_first_letter'=> $component['settings']['font_first_letter'],
                                'fonts' => $component['settings']['fonts'],
                                'font_colors' => $component['settings']['font_colors'],
                                'width' => $component['settings']['position']['width'],
                                'height' => $component['settings']['position']['height'],
                                'origin_x' => $component['settings']['position']['origin_x'],
                                'origin_y' => $component['settings']['position']['origin_y']
                            );
                            array_push($events_customsArray, $eventsCustomInputArray);
                        }
                    }
                }
                // Products_variants
                foreach($events_product->variants as $variant) {
                    $products_variant = Products_variants::find($variant[0]);
                    $productsVariantData = array(
                        'size' => $products_variant->size,
                        'color' => $products_variant->color,
                        'image' => $products_variant->image,
                        'quantity' => $variant[1]
                    );
                    array_push($productsVariantsArray, $productsVariantData);
                }
                // Final JSON
                $eventLocalDownloadProduct = array(
                    'title' => $events_product->title,
                    'gender' => $product->gender,
                    'type' => $product->product_type,
                    'printzones' => $printzonesArray,
                    'products_variants' => $productsVariantsArray,
                    'events_customs' => $events_customsArray
                );
                array_push($eventLocalDownloadProducts, $eventLocalDownloadProduct);
            }
            $event_local_download->products = $eventLocalDownloadProducts;
            // Update event is_ready
            $event->is_ready = true;
            $locals = Event_local_download::where('eventId','=',$event->id)->get();
            foreach($locals as $local) {
                $local->delete();
            }
            $event->update();
            // Save and response send
            $event_local_download->save();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id) {
        $event = Event::find($event_id);
        $event->is_ready = false;
        $event_local_downloads = Event_local_download::where('eventId','=',$event_id)->get();
        $event->update();
        foreach($event_local_downloads as $event_local_download) {
            $event_local_download->delete();
        }
        $response = array(
            'status' => 'success',
            'msg' => 'The event is not ready now.',
            'event_local_downloads' => $event_local_downloads
        );
        return response()->json($response);
    }
}
