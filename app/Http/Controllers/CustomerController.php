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
            'denomination' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'siren' => 'string|max:255',
            'activite' => 'required|string|max:255',
            'nb_events' => 'required|integer',
            'contact_nom' => 'required|string|max:255',
            'contact_prenom' => 'required|string|max:255',
            'contact_telephone' => 'required|string|max:255',
            'contact_poste' => 'required|string|max:255',
            'informations' => 'max:750'
        ]);

        $customer = new Customer;
        $customer->denomination = $request->denomination;
        $customer->adresse = $request->adresse;
        $customer->code_postal = $request->code_postal;
        $customer->activite = $request->activite;
        $customer->ville = $request->ville;
        $customer->siren = $request->siren;
        $customer->nb_events = $request->nb_events;
        $customer->contact_nom = $request->contact_nom;
        $customer->contact_prenom = $request->contact_prenom;
        $customer->contact_telephone = $request->contact_telephone;
        $customer->contact_poste = $request->contact_poste;
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
        if (request('actual_denomination') == request('denomination')){
            $validatedData = $request->validate([
            'denomination' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'siren' => 'required|string|max:255',
            'activite' => 'required|string|max:255',
            'nb_events' => 'required|integer',
            'contact_nom' => 'required|string|max:255',
            'contact_prenom' => 'required|string|max:255',
            'contact_telephone' => 'required|string|max:255',
            'contact_poste' => 'required|string|max:255',
            'informations' => 'max:750'
        ]);
            $id = $request->id;

            $customer = Customer::find($id);
            $customer->denomination = $request->denomination;
            $customer->adresse = $request->adresse;
            $customer->code_postal = $request->code_postal;
            $customer->ville = $request->ville;
            $customer->siren = $request->siren;
            $customer->activite = $request->activite;
            $customer->nb_events = $request->nb_events;
            $customer->contact_nom = $request->contact_nom;
            $customer->contact_prenom = $request->contact_prenom;
            $customer->contact_telephone = $request->contact_telephone;
            $customer->contact_poste = $request->contact_poste;
            $customer->informations = $request->informations;
            $customer->event_id = $request->event_id;
            $customer->save();

        }        
        else{
            $validatedData = $request->validate([
                'denomination' => 'required|string|max:255',
                'adresse' => 'required|string|max:255',
                'code_postal' => 'required|string|max:255',
                'ville' => 'required|string|max:255',
                'siren' => 'required|string|max:255',
                'activite' => 'required|string|max:255',
                'nb_events' => 'required|integer',
                'contact_nom' => 'required|string|max:255',
                'contact_prenom' => 'required|string|max:255',
                'contact_telephone' => 'required|string|max:255',
                'contact_poste' => 'required|string|max:255',
                'informations' => 'max:750'
            ]);
            $id = $request->id;
    
            $customer = Customer::find($id);
            $customer->denomination = $request->denomination;
            $customer->adresse = $request->adresse;
            $customer->code_postal = $request->code_postal;
            $customer->ville = $request->ville;
            $customer->siren = $request->siren;
            $customer->activite = $request->activite;
            $customer->nb_events = $request->nb_events;
            $customer->contact_nom = $request->contact_nom;
            $customer->contact_prenom = $request->contact_prenom;
            $customer->contact_telephone = $request->contact_telephone;
            $customer->contact_poste = $request->contact_poste;
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
