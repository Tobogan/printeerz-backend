<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Customer;
use App\Product;
use App\Printzones;
use App\Events_products;;
use App\User;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $exists = $disk->exists('file.jpg');
        return view('admin/Event.index', ['events' => $events, 'disk' => $disk, 's3' => $s3, 'exists' => $exists]);
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
        return view('admin/Event.add', ['events' => $events, 'select_customers' => $select_customers, 'products' => $products]);
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
            'name' => 'required|string|max:255',
            'advertiser' => 'required|string|max:255',
            'type' => 'string|max:255',
            'logo_img' => 'max:4000',
            'cover_img' => 'max:4000',
            'BAT' => 'max:4000',
            'description' => 'max:2750'
        ]);

        $event = new Event;
        $event->name = $request->name;
        $event->advertiser = $request->advertiser;
        $event->customer_id = $request->customer_id;
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
        $event->type = $request->type;
        $event->description = $request->description;
        $event->event_products_id=$request->get('event_products_id');
        $event->employee=$request->get('employees');
        $event->comments = array(
            'id' => $request->comment_id,
            'employee_id' => $request->employee_id,
            'comment' => $request->comment,
            'created_at' => $request->created_at
        );

        $event->save();

        $disk = Storage::disk('s3');
        if ($request->hasFile('logo_img')){
            // Get file
            $file = $request->file('logo_img');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/events/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $event->logoName = $filePath;
        }
        if ($request->hasFile('cover_img')){
            // Get file
            $file = $request->file('cover_img');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/events/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $event->cover_img = $filePath;
        }
        if ($request->hasFile('BAT')){
            // Get file
            $file = $request->file('cover_img');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/events/' . $name;
            // Upload the file
            $disk->put($filePath, $file, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $event->BAT = $filePath;
        } 
        $event->save();
        $notification = array(
            'status' => 'L\'événement a été correctement ajouté.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/index')->with($notification);
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
        $products = Product::all();
        $events_products = Events_products::all();
        $printzones = Printzones::all();
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $select_products = [];
        foreach($products as $product) {
            $select_products[$product->id] = $product->title;
        }
        return view('admin/Event.show', ['printzones' => $printzones, 'select_products' => $select_products,
        'events_products' => $events_products, 'products' => $products, 'event' => $event, 'disk' => $disk, 's3' =>
        $s3]);
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
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        return view('admin/Event.show_eventVariants', ['event' => $event, 'productVariants' => $productVariants,
        'eventVariants' => $eventVariants, 'disk' => $disk, 's3' => $s3]);
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
        return view('admin/Event.edit', ['event' => $event, 'select_customers' => $select_customers, 'products' => $products]);
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
        if (request('actual_name') == request('name')){
            $validatedData = $request->validate([
                'advertiser' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'logo_img' => 'max:4000',
                'cover_img' => 'max:4000',
                'BAT' => 'max:4000',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);
            $events = Event::all();
            $event->name = $request->name;
            $event->advertiser = $request->advertiser;
            $event->customer_id = $request->customer_id;
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
            $event->type = $request->type;
            $event->description = $request->description;

            $event_products_id[]=$request->get('event_products_id');
            $event->event_products_id=$event_products_id;

            $employees[]=$request->get('employees');
            $event->employees=$employees;

            $event->comments = array(
                'id' => $request->comment_id,
                'employee_id' => $request->employee_id,
                'comment' => $request->comment,
                'created_at' => $request->created_at
            );
            $products = Product::all();
            $customers = Customer::all();
            $select_customers = [];
            foreach($customers as $customer) {
                $select_customers[$customer->id] = $customer->title;
            }
            
            $event->save();

            // Update logo image
           if ($request->hasFile('logo_img')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->logoName;
                // Get new image
                $file = $request->file('logo_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $event->id . '/'. $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
                // Upload the new image
                $disk->put($newFilePath, $img, 'public');
                // Put in database
                $event->logoName = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->logoName ) && $disk->exists($newFilePath)){
                $disk->delete($oldPath);
                }
           }

            // Update Cover image
           if ($request->hasFile('cover_img')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->logo_img;
                // Get new image
                $file = $request->file('cover_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $event->id . '/'. $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
                // Upload the new image
                $disk->put($newFilePath, $img, 'public');
                // Put in database
                $event->cover_img = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->cover_img) && $disk->exists($newFilePath)){
                $disk->delete($oldPath);
                }
           }

            // Update BAT File
            if ($request->hasFile('BAT')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->BAT;
                // Get new image
                $file = $request->file('BAT');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $product->id . '/'. $name;
                // Upload the new image
                $disk->put($newFilePath, $file, 'public');
                // Put in database
                $event->BAT = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->BAT) && $disk->exists($newFilePath)){
                $disk->delete($oldPath);
                }
            }

            $event->save();
        }        
        else {
            $validatedData = $request->validate([
                'advertiser' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'logo_img' => 'max:4000',
                'cover_img' => 'max:4000',
                'BAT' => 'max:4000',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);
            $event->name = $request->name;
            $event->advertiser = $request->advertiser;
            $event->customer_id = $request->customer_id;
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
            $event->type = $request->type;
            $event->description = $request->description;
            $event_products_id[] = $request->get('event_products_id');
            $event->event_products_id = $event_products_id;
            $employees[] = $request->get('employees');
            $event->employees = $employees;
            $event->comments = array(
                'id' => $request->comment_id,
                'employee_id' => $request->employee_id,
                'comment' => $request->comment,
                'created_at' => $request->created_at
            );
            $events = Event::all();
            $products = Product::all();
            $customers = Customer::all();
            $select_customers = [];
            foreach($customers as $customer) {
                $select_customers[$customer->id] = $customer->title;
            }

            $event->save();

            // Update logo image
            if ($request->hasFile('logo_img')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->logoName;
                // Get new image
                $file = $request->file('logo_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $event->id . '/'. $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->widen(300)->save($name);
                // Upload the new image
                $disk->put($newFilePath, $img, 'public');
                // Put in database
                $event->logoName = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->logoName) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }

            // Update Cover image
            if ($request->hasFile('cover_img')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->logo_img;
                // Get new image
                $file = $request->file('cover_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $event->id . '/'. $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
                // Upload the new image
                $disk->put($newFilePath, $img, 'public');
                // Put in database
                $event->cover_img = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->cover_img) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }

            // Update BAT File
            if ($request->hasFile('BAT')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $event->BAT;
                // Get new image
                $file = $request->file('BAT');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/events/' . $product->id . '/'. $name;
                // Upload the new image
                $disk->put($newFilePath, $file, 'public');
                // Put in database
                $event->BAT = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($event->BAT) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }

            $event->save();
        }
        
        $notification = array(
        'status' => 'L\'événement a été correctement modifié.',
        'alert-type' => 'success'
        );

        return redirect('admin/Event/index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        // Delete logo image
        $disk = Storage::disk('s3');
        $filePath = $event->logoName;
        if(!empty($event->logoName) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }
        // Delete cover image
        $filePath = $event->cover_img;
        if(!empty($event->cover_img) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }
        // Delete BAT file
        $filePath = $event->BAT;
        if(!empty($event->BAT) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }

        // Delete file
        $event->delete();

        $notification = array(
            'status' => 'L\'événement a été correctement supprimé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/index')->with($notification);
    }

    
    public function desactivate($id)
    {
        $event = Event::find($id);
        $event->is_active = false;
        $event->update();
        $notification = array(
            'status' => 'L\'événement a été correctement désactivé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/index')->with($notification);
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $event->is_deleted = true;
        $event->update();
        $notification = array(
            'status' => 'L\'événement a été correctement supprimé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/index')->with($notification);
    }

    public function activate($id)
    {
        $event = Event::find($id);
        $event->is_active = true;
        $event->update();
        $notification = array(
            'status' => 'L\'événement a été correctement activé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Event/index')->with($notification);
    }
}
