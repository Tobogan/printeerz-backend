<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;
use Illuminate\Support\Facades\Input;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class CustomerController extends Controller
{
    public function __construct(){
        //$this->middleware(isActivate::class);
        //$this->middleware(isAdmin::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $events = Event::all();
        // $select = [];
        // foreach($events as $event) {
        //     $select[$event->id] = $event->nom;
        // }
        return view('admin/Customer.index', ['customers' => $customers, 'events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('admin/Customer.add', ['customers' => $customers]);
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
            'title' => 'required|string|max:255',
            'activity_type' => 'required|string|max:255',
            'SIREN' => 'string|max:9',
            'location' => 'string|max:255',
            'contact_person' => 'string|max:255',
            'comments' => 'max:750'
        ]);

        $customer = new Customer;
        $customer->title = $request->title;
        $customer->activity_type = $request->activity_type;
        $customer->SIREN = $request->SIREN;
        $customer->comments = $request->comments;
        $customer->contact_person = array(
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'job_title' => $request->job_title
        );
        $customer->location = array(
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'lattitude' => $request->lattitude
        );
        $customer->events_id=$request->get('shows_id');
        $customer->is_active = $request->is_active;
        $customer->is_deleted = $request->is_deleted;

        $disk = Storage::disk('s3');
        if ($request->hasFile('image')){
            // Get file
            $file = $request->file('image');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/customers/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $customer->image = $filePath;
        }
        $customer->save();
        $notification = array(
            'status' => 'Le client a été correctement ajouté',
            'alert-type' => 'success'
        );
        return redirect('admin/Customer/index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $events = Event::all();
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $exists = $disk->exists('file.jpg');
        return view('admin/Customer.show', ['events' => $events, 'disk' => $disk, 's3' => $s3, 'customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin/Customer.edit', ['customer' => $customer]);
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
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        if (request('actual_title') == request('title')){
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'activity_type' => 'required|string|max:255',
                'SIREN' => 'string|max:255',
                'location' => 'string|max:255',
                'contact_person' => 'string|max:255',
                'comments' => 'max:750'
        ]);
        $id = $request->id;
        $customer = Customer::find($id);
        $customer->title = $request->title;
        $customer->activity_type = $request->activity_type;
        $customer->SIREN = $request->SIREN;
        $customer->comments = $request->comments;
        $customer->contact_person = array(
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'job_title' => $request->job_title
        );
        $customer->location = array(
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'lattitude' => $request->lattitude
        );
        $customer->events_id=$request->get('shows_id');
        $customer->is_active = $request->is_active;
        $customer->is_deleted = $request->is_deleted;

        // Update Profile image
        if ($request->hasFile('image')){
            // Get current image path
            $oldPath = $customer->image;
            // Get new image
            $file = $request->file('image');
            // Create image name
            $name = time() . $file->getClientOriginalName();
            // Define the new path to image
            $newFilePath = '/customers/' . $name;
            // Resize new image
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            // Upload the new image
            $disk = Storage::disk('s3');
            $disk->put($newFilePath, $img, 'public');
            unlink(public_path() . '/' . $name);
            // Put in database
            $customer->image = $newFilePath;
            if(!empty($customer->image) && $disk->exists($newFilePath)){
                $disk->delete($oldPath);
            }
        }
        $customer->save();
        }        
        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'activity_type' => 'required|string|max:255',
                'SIREN' => 'string|max:255',
                'location' => 'string|max:255',
                'contact_person' => 'string|max:255',
                'comments' => 'max:750'
        ]);
        $id = $request->id;

        $customer = Customer::find($id);
        $customer->title = $request->title;
        $customer->activity_type = $request->activity_type;
        $customer->SIREN = $request->SIREN;
        $customer->comments = $request->comments;
        $customer->contact_person = array(
        'lastname' => $request->lastname,
        'firstname' => $request->firstname,
        'email' => $request->email,
        'phone' => $request->phone,
        'job_title' => $request->job_title
        );
        $customer->location = array(
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'lattitude' => $request->lattitude
        );
        $customer->events_id = $request->get('shows_id');
        $customer->is_active = $request->is_active; 
        $customer->is_deleted = $request->is_deleted;

        // Update Profile image
        if ($request->hasFile('image')){
            // Get current image path
            $oldPath = $customer->image;
            // Get new image
            $file = $request->file('image');
            // Create image name
            $name = time() . $file->getClientOriginalName();
            // Define the new path to image
            $newFilePath = '/customers/' . $name;
            // Resize new image
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            // Upload the new image
            $disk = Storage::disk('s3');
            $disk->put($newFilePath, $img, 'public');
            unlink(public_path() . '/' . $name);
            // Put in database
            $customer->image = $newFilePath;
            if(!empty($customer->image) && $disk->exists($newFilePath)){
            $disk->delete($oldPath);
            }
        }
        $customer->save();
        }     
        $notification = array(
            'status' => 'Le client a été correctement modifié',
            'alert-type' => 'success'
        );
        return redirect('admin/Customer/show/' . $customer->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        // Delete Profile image
        $disk = Storage::disk('s3');
        $filePath = $customer->image;
        if(!empty($customer->image) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }
        $customer->delete();
        $notification = array(
        'status' => 'Le client a été correctement été effacé',
        'alert-type' => 'success'
        );
        return redirect('admin/Customer/index')->with($notification);
    }

    public function desactivate($id)
    {
        $customer = Customer::find($id);
        $customer->is_active = false;
        $customer->update();
        return redirect('admin/Customer/index');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->is_deleted = true;
        $customer->update();
        return redirect('admin/Customer/index');
    }

    public function activate($id)
    {
        $customer = Customer::find($id);
        $customer->is_active = true;
        $customer->update();
        return redirect('admin/Customer/index');
    }
}
