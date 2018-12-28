<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;


class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware(isActivate::class);
        $this->middleware(isAdmin::class);
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
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'siren' => 'string|max:255',
            'activity' => 'required|string|max:255',
            'event_qty' => 'required|integer',
            'contact_lastname' => 'required|string|max:255',
            'contact_firstname' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:255',
            'contact_job' => 'required|string|max:255',
            'informations' => 'max:750'
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->adress = $request->adress;
        $customer->postal_code = $request->postal_code;
        $customer->activity = $request->activity;
        $customer->city = $request->city;
        $customer->siren = $request->siren;
        $customer->event_qty = $request->event_qty;
        $customer->contact_lastname = $request->contact_lastname;
        $customer->contact_firstname = $request->contact_firstname;
        $customer->contact_email = $request->contact_email;
        $customer->contact_phone = $request->contact_phone;
        $customer->contact_job = $request->contact_job;
        $customer->informations = $request->informations;
        $customer->event_id = $request->event_id;
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
        return view('admin/Customer.show', ['customer' => $customer]);
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
        if (request('actual_name') == request('name')){
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'siren' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'event_qty' => 'required|integer',
            'contact_lastname' => 'required|string|max:255',
            'contact_firstname' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:255',
            'contact_job' => 'required|string|max:255',
            'informations' => 'max:750'
        ]);
            $id = $request->id;

            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->adress = $request->adress;
            $customer->postal_code = $request->postal_code;
            $customer->city = $request->city;
            $customer->siren = $request->siren;
            $customer->activity = $request->activity;
            $customer->event_qty = $request->event_qty;
            $customer->contact_lastname = $request->contact_lastname;
            $customer->contact_firstname = $request->contact_firstname;
            $customer->contact_email = $request->contact_email;
            $customer->contact_phone = $request->contact_phone;
            $customer->contact_job = $request->contact_job;
            $customer->informations = $request->informations;
            $customer->event_id = $request->event_id;
            $customer->save();

        }        
        else{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'adress' => 'required|string|max:255',
                'postal_code' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'siren' => 'required|string|max:255',
                'activity' => 'required|string|max:255',
                'event_qty' => 'required|integer',
                'contact_lastname' => 'required|string|max:255',
                'contact_firstname' => 'required|string|max:255',
                'contact_phone' => 'required|string|max:255',
                'contact_job' => 'required|string|max:255',
                'informations' => 'max:750'
            ]);
            $id = $request->id;
    
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->adress = $request->adress;
            $customer->postal_code = $request->postal_code;
            $customer->city = $request->city;
            $customer->siren = $request->siren;
            $customer->activity = $request->activity;
            $customer->event_qty = $request->event_qty;
            $customer->contact_lastname = $request->contact_lastname;
            $customer->contact_firstname = $request->contact_firstname;
            $customer->contact_email = $request->contact_email;
            $customer->contact_phone = $request->contact_phone;
            $customer->contact_job = $request->contact_job;
            $customer->informations = $request->informations;
            $customer->event_id = $request->event_id;
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
        $customer->delete();
        return redirect('admin/Customer/index')->with('status', 'Le client a été correctement supprimé.');
    }
}
