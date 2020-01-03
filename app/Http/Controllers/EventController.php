<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Customer;
use App\Product;
use App\Printzones;
use App\Events_products;
use App\Events_customs;
use App\Events_component;
use App\Event_local_download;
use App\User;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(){
        //$this->middleware(isActivate::class);
        // $this->middleware(isAdmin::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $events = Event::all();
        $disk = Storage::disk('s3');
        $exists = $disk->exists('file.jpg');
        return view('admin/Event.index', [
            'events' => $events, 
            'disk' => $disk,
            'exists' => $exists
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $events = Event::all();
        $products = Product::all();
        $customers = Customer::all();
        $select_customers = [];
        foreach($customers as $customer) {
            $select_customers[$customer->id] = $customer->title;
        }
        return view('admin/Event.add', [
            'events' => $events, 
            'select_customers' => $select_customers, 
            'products' => $products
            ]
        );
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientCreate($id){
        $events = Event::all();
        $products = Product::all();
        $customers = Customer::all();
        $select_customers = [];
        foreach($customers as $customer) {
            if($customer->id == $id){
                $select_customers[$customer->id] = $customer->title;
            }
        }
        return view('admin/Event.add', [
            'events' => $events, 
            'select_customers' => $select_customers, 
            'products' => $products
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(){
        $prod_id = Input::get('product_id');
        $productVariants = ProductVariants::where('product_id', '=', $prod_id)->get();
        return Response::json($productVariants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:events|string|max:255',
            'advertiser' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'employees' => 'required',
            'logo_img' => 'image|mimes:jpeg,jpg,png|max:4000',
            'cover_img' => 'image|mimes:jpeg,jpg,png|max:4000',
            'BAT' => 'mimes:pdf|max:4000',
            'start_datetime'=>'required|date|before_or_equal:end_datetime',
            'description' => 'nullable|string|max:2750'
        ]);
        $event = new Event;
        $event->created_by = Auth::user()->username;
        $event->title = $request->name;
        $event->advertiser = $request->advertiser;
        $event->customer_id = $request->customer_id;
        $event->status = "draft";
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;
        $event->event_products_id   = array();
        $event->products = array();
        $event->location = array(
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'lattitude' => $request->lattitude
        );
        $event->type = $request->type;
        $event->description = $request->description;
        $event->user_ids = $request->get('employees');
        $event->save();
        $disk = Storage::disk('s3');
        if ($request->hasFile('logo_img')){
            $file = $request->file('logo_img');
            $name = $file->getClientOriginalName();
            $filePath = 'events/' . $event->id . '/'. $name;
            $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
            $disk->put($filePath, $img, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            $logo = [
                'url' => $filePath
            ];
        }

        if ($request->hasFile('cover_img')) {
            $disk = Storage::disk('s3');
            $file = $request->file('cover_img');
            $name = time() . $file->getClientOriginalName();
            $thumbFilePath = 'events/' . $event->id . '/covers/thumb/'. $name;
            $filePath = 'events/' . $event->id . '/covers/original/'.$name;
            $image = Image::make(file_get_contents($file));
            $image->backup();
            $image->resize(1080, 1920)->save($name);
            $disk->put($thumbFilePath, $image, 'public');
            $image->reset();
            $image->resize(512, 786);
            $disk->put($filePath, $image, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            $cover = [
                'url' => $filePath,
                'thumb_url' => $thumbFilePath
            ];
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
        }
        if ($request->hasFile('BAT')){
            $file = $request->file('BAT');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'events/' . $event->id . '/'. $name;
            $disk->put($filePath, file_get_contents($file), 'public');
            $event->files = [
                'bat' => [
                    'url' => $filePath
                ]
            ];
        }
        if (isset($cover) && isset($logo)) {
            $event->images = [
                'cover' => $cover,
                'logo' => $logo
            ];
        }
        elseif (isset($cover) && !isset($logo)) {
            $event->images = [
                'cover' => $cover,
                'logo' => $event->images['logo']['url']
            ];
        }
        elseif (!isset($cover) && isset($logo)) {
            $event->images = [
                'cover' => [
                    'url' => $event->images['cover']['url'],
                    'thumb_url' => $event->images['cover']['thumb_url']
                ],
                'logo' => $logo
            ];
        }
        $event->save();
        // here I push the id in the corresponding customer
        $customer = Customer::find($event->customer_id);
        if (!$customer->events_id) {
            $customer->events_id = [];
            $arr_event= $customer->events_id;
            array_push($arr_event, $event->id);
            $customer->events_id = $arr_event;
            $customer->update();
        }
        else {
            $arr_event= $customer->events_id;
            array_push($arr_event, $event->id);
            $customer->events_id = $arr_event;
            $customer->update();
        }
        $notification = array(
            'status' => 'L\'événement a été correctement ajouté.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/show/' . $event->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $users = User::all();
        $products = Product::all();
        $events_products = Events_products::all();
        $printzones = Printzones::all();
        $disk = Storage::disk('s3');
        $select_products = [];
        foreach ($products as $product) {
            $select_products[$product->id] = $product->title;
        }
        return view('admin/Event.show', [
            'event' => $event, 
            'users' => $users, 
            'printzones' => $printzones, 
            'select_products' => $select_products,
            'events_products' => $events_products, 
            'products' => $products, 
            'disk' => $disk
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_eventVariants($id)
    {
        $event = Event::find($id);
        $eventVariants = EventVariants::all();
        $productVariants = ProductVariants::all();
        $disk = Storage::disk('s3');
        return view('admin/Event.show_eventVariants', [
            'event' => $event,
            'productVariants' => $productVariants,
            'eventVariants' => $eventVariants, 
            'disk' => $disk
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $products = Product::all();
        $customers = Customer::all();
        $select_customers = [];
        foreach($customers as $customer) {
            $select_customers[$customer->id] = $customer->title;
        }
        return view('admin/Event.edit', [
            'event' => $event, 
            'select_customers' => $select_customers, 
            'products' => $products
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request('actual_customer_id') == request('customer_id') || request('actual_customer_id') !== request('customer_id')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'advertiser' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'customer_id' => 'required|string|max:255',
                'employees' => 'required',
                'logo_img' => 'image|mimes:jpeg,jpg,png|max:4000',
                'cover_img' => 'image|mimes:jpeg,jpg,png|max:4000',
                'BAT' => 'mimes:pdf|max:4000',
                'start_datetime'=>'required|date|before_or_equal:end_datetime',
                'end_time' => 'required',
                'start_time' => 'required',
                'description' => 'nullable|string|max:2750'
            ]);
            $event = Event::find($request->id);
            if (request('actual_customer_id') !== request('customer_id')) {
                // delete event id in the customer data
                $customer = Customer::find($event->customer_id);
                $result = app('App\Http\Controllers\EventsCustomsController')->removeElement($customer->events_id, $event->id);
                $arr = $customer->events_id;
                $customer->events_id = $result;
                $customer->update();
                $event->customer_id = $request->customer_id;
                // here I push the id in the corresponding customer
                $customer = Customer::find($request->customer_id);
                $arr_event= $customer->events_id;
                array_push($arr_event, $event->id);
                $customer->events_id = $arr_event;
                $customer->update();
            }
            $event->title= $request->name;
            $event->advertiser = $request->advertiser;
            $event->status = 'draft';
            $event->location = array(
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
                'longitude' => $request->longitude,
                'lattitude' => $request->lattitude
            );
            $event->start_datetime = $request->start_datetime;
            $event->end_datetime = $request->end_datetime;
            $event->start_time = $request->start_time;
            $event->end_time = $request->end_time;
            $event->type = $request->type;
            $event->description = $request->description;
            // $event->event_products_id = $request->get('event_products_id');
            $event->user_ids=$request->get('employees');
            // Update logo image
           if ($request->hasFile('logo_img')){
                $disk = Storage::disk('s3');
                $file = $request->file('logo_img');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = 'events/' . $event->id . '/'. $name;
                $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
                $disk->put($newFilePath, $img, 'public');
                $logo = [
                    'url' => $newFilePath
                ];
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                if (!empty($event->logo ) && $disk->exists($newFilePath)) {
                    $disk->delete($event->logoUrl);
                }
           }
            // Update Cover image
           if ($request->hasFile('cover_img')) {
                $disk = Storage::disk('s3');
                $file = $request->file('cover_img');
                $name = time() . $file->getClientOriginalName();
                $thumbFilePath = 'events/' . $event->id . '/covers/thumb/'. $name;
                $filePath = 'events/' . $event->id . '/covers/original/'.$name;
                $image = Image::make(file_get_contents($file));
                $image->backup();
                $image->resize(1080, 1920)->save($name);
                $disk->put($thumbFilePath, $image, 'public');
                $image->reset();
                $image->resize(512, 786);
                $disk->put($filePath, $image, 'public');
                $cover = [
                    'url' => $filePath,
                    'thumb_url' => $thumbFilePath
                ];
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                if (isset($event->images['cover']['thumb_url'])) {
                    if(!empty($event->images['cover']['thumb_url']) && $disk->exists($event->images['cover']['thumb_url'])){
                        $disk->delete($event->images['cover']['thumb_url']);
                    }
                }
                if (isset($event->images['cover']['url'])) {
                    if(!empty($event->images['cover']['url']) && $disk->exists($event->images['cover']['url'])){
                        $disk->delete($event->images['cover']['url']);
                    }
                }
           }
            if ($request->hasFile('BAT')) {
                $disk = Storage::disk('s3');
                $file = $request->file('BAT');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = 'events/' . $event->id . '/'. $name;
                $disk->put($newFilePath, file_get_contents($file), 'public');
                $event->files = [
                    'bat' => [
                        'url' => $newFilePath
                    ]
                ];
                if (!empty($event->BAT) && $disk->exists($newFilePath)) {
                    $disk->delete($event->BATUrl);
                }
            }
        }
        if (isset($cover) && isset($logo)) {
            $event->images = [
                'cover' => $cover,
                'logo' => $logo
            ];
        }
        elseif (isset($cover) && !isset($logo)) {
            $event->images = [
                'cover' => $cover,
                'logo' => $event->images['logo']['url']
            ];
        }
        elseif (!isset($cover) && isset($logo)) {
            $event->images = [
                'cover' => $event->images['cover']['url'],
                'logo' => $logo
            ];
        }
        $event_local_download = Event_local_download::where('eventId','=',$event->id);
        if ($event_local_download) {
            $event_local_download->delete();
        }
        $event->update();
        $notification = [
            'status' => 'L\'événement a été correctement modifié.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/show/' . $event->id)->with($notification);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, $event_id, $new_status) {
        if ($request->ajax()) {
            $event = Event::find($event_id);
            $event->status = $new_status;
            $event->update();
            $response = [
                'status' => 'success',
                'msg' => 'You have change event\'s status.'
            ];
            return response()->json($response);
        }
        else {
            return 'no';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $event = Event::find($id);
        // Delete logo image
        $disk = Storage::disk('s3');
        Storage::disk('s3')->deleteDirectory('/events/'.$id);
        // Delete events_customs of this event
        $events_products = Events_products::where('event_id', '=', $id)->get();
        if ($events_products != null){
            foreach($events_products as $events_product){
                app('App\Http\Controllers\EventsProductsController')->destroy($events_product->id);
            }
        }
        // Delete events_customs of this event
        $events_customs = Events_customs::where('event_id', '=', $id)->get();
        if($events_customs != null){
            foreach($events_customs as $events_custom){
                app('App\Http\Controllers\EventsCustomsController')->destroy($events_custom->id);
            }
        }
        // Delete events_component of this event
        $events_components = Events_component::where('event_id', '=', $id)->get();
        if($events_components != null){
            foreach($events_components as $events_component){
                app('App\Http\Controllers\EventsComponentController')->destroy($events_component->id);
            }
        }
         // Delete events_local download of this event
         if ($event->event_local_download_id !== null)
        app('App\Http\Controllers\EventLocalDownloadController')->destroy($id);
        // delete event id in the customer data
        $customer = Customer::find($event->customer_id);
        if ($customer->events_id) {
            $result = app('App\Http\Controllers\EventsCustomsController')->removeElement($customer->events_id, $event->id);
            $arr = $customer->events_id;
            $arr = $result;
            $customer->events_id = $arr;
            $customer->update();
        }
        // Now I can delete the event
        $event->delete();
        $notification = [
            'status' => 'L\'événement a été correctement supprimé.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/index')->with($notification);
    }

    public function desactivate($id) {
        $event = Event::find($id);
        $event->is_active = false;
        $event->update();
        $notification = [
            'status' => 'L\'événement a été correctement désactivé.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/index')->with($notification);
    }

    public function delete($id) {
        $event = Event::find($id);
        $event->is_deleted = true;
        $event->update();
        $notification = [
            'status' => 'L\'événement a été correctement supprimé.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/index')->with($notification);
    }

    public function activate($id) {
        $event = Event::find($id);
        $event->is_active = true;
        $event->update();
        $notification = [
            'status' => 'L\'événement a été correctement activé.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/index')->with($notification);
    }

    public function is_not_ready($id) {
        $event = Event::find($id);
        $event->status = "draft";
        $event_local_download = Event_local_download::where($event_local_download->event_id,'=',$event->id);
        if ($event_local_download !== null) {
            app('App\Http\Controllers\EventLocalDownloadController')->destroy($event_local_download->id);
        }
        $event->update();
        $notification = [
            'status' => 'L\'événement n\'est plus prêt.',
            'alert-type' => 'success'
        ];
        return redirect('admin/Event/index')->with($notification);
    }
}
