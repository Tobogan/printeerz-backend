<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;
use Illuminate\Support\Facades\Input;


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
            'SIREN' => 'string|max:255',
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
        $shows_id[]=$request->get('shows_id');
        $customer->shows_id=$shows_id;
        $customer->is_active = $request->is_active;
        $customer->is_deleted = $request->is_deleted;

        /*~~~~~~~~~~~___________UPLOAD IMAGE CUSTOMER__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $imageName);

            $customer->image = $imageName;
        } 

        $customer->save();

        return redirect('admin/Customer/index')->with('status', 'Le client a été correctement ajouté.');
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
        return view('admin/Customer.show', ['events' => $events, 'customer' => $customer]);
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
        $shows_id[]=$request->get('shows_id');
        $customer->events=$shows_id;
        $customer->is_active = $request->is_active;
        $customer->is_deleted = $request->is_deleted;

        /*~~~~~~~~~~~___________UPLOAD IMAGE CUSTOMER__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $file_path = public_path('uploads/'.$customer->image);
            if(file_exists(public_path('uploads/'.$customer->image)) && !empty($customer->image)){
                unlink($file_path);
            }
            $imageName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $imageName);

            $customer->image = $imageName;
        } 
        $customer->save();
        }        
        else{
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
        $shows_id[]=$request->get('shows_id');
        $customer->events=$shows_id;
        $customer->is_active = $request->is_active; //penser à mettre l'input hidden
        $customer->is_deleted = $request->is_deleted;
        /*~~~~~~~~~~~___________UPLOAD IMAGE CUSTOMER__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $file_path = public_path('uploads/').$customer->image;
            if(file_exists(public_path('uploads/'.$customer->image)) && !empty($customer->image)){
                unlink($file_path);
            }
            $imageName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $imageName);

            $customer->image = $imageName;
        } 
        $customer->save();
        }     
        return view('admin/Customer.show', ['customer' => $customer])->with('status', 'Le client a été correctement modifié.');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $file_path = public_path('uploads/').$customer->image;
        if(file_exists(public_path('uploads/'.$customer->image)) && !empty($customer->image)){
            unlink($file_path);
        }
        $customer->delete();
        return redirect('admin/Customer/index')->with('status', 'Le client a été correctement supprimé.');
    }

        /*--~~~~~~~~~~~___________activate and desactivate a customer function in index Customer__________~~~~~~~~~~~~-*/
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
