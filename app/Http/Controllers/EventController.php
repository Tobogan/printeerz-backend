<?php

namespace App\Http\Controllers;

/*~~~~~~~~~~~___________MODELS__________~~~~~~~~~~~~*/
use DB;
use App\Event;
use App\Customer;
use App\Product;
use App\Couleur;
use App\Gabarit;
use App\User;
use App\ProductVariants;
use App\EventVariants;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

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
        return view('admin/Event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $customers = Customer::all();
        $select = [];
        foreach($customers as $customer){
            $select[$customer->id] = $customer->name;
        }
        $products = Product::all();
        $select_products = [];
        foreach($products as $product){          
                $select_products[$product->id] = $product->nom;
        }
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        $productVariants = ProductVariants::all();
    
        return view('admin/Event.add', ['couleurs'=> $couleurs, 'productVariants' => $productVariants, 'select' => $select, 'select_couleurs' => $select_couleurs, 'select_products' => $select_products, 'products' => $products]);
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
            'nom' => 'required|string|max:255',
            'annonceur' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lieu' => 'required|string|max:255',
            'description' => 'max:750'
        ]);

        $event = new Event;

        $event->nom = $request->nom;
        $event->annonceur = $request->annonceur;
        $event->customer_id = $request->customer_id;
        $event->save();
        $event->product_id = $request->product_id;
        $event->users()->sync($request->get('users_list'));
        $event->lieu = $request->lieu;
        $event->type = $request->type;
        $event->date = $request->date;
        $event->description = $request->description;

        $event->save();

/*~~~~~~~~~~~___________UPLOADS IMAGES__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $logoName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $logoName);

            $event->logoName = $logoName;
        } 

        if ($request->hasFile('BAT')){
            $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
            request()->BAT->move(public_path('uploads'), $BAT_name);

            $event->BAT_name = $BAT_name;
        } 

        $event->save();
        // return redirect('admin/Event/index')->with('status', 'L\'événement a été correctement ajouté.');
        $eventVariants = EventVariants::all();
        return view('admin/Event.show',['eventVariants' => $eventVariants, 'event' => $event, 'id' => $event->id])->with('status', 'Le produit a été correctement ajouté.');    
 
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
        $product = Product::find($id);
        $couleurs = Couleur::all();
        $eventVariants = EventVariants::all();
        $user = User::find($id);
        return view('admin/Event.show', ['eventVariants' => $eventVariants, 'event' => $event, 'couleurs' => $couleurs, 'product' => $product, 'user' => $user]);
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
        return view('admin/Event.show_eventVariants', ['event' => $event, 'productVariants' => $productVariants, 'eventVariants' => $eventVariants]);
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
        $customers = Customer::all();
        $products = Product::all();
        $select = [];
        foreach($customers as $customer){
            $select[$customer->id] = $customer->name;
        }
        $products = Product::all();
        $select_products = [];
        foreach($products as $product){          
                $select_products[$product->id] = $product->nom;
        }
        $gabarits = Gabarit::all();
        $select_gabarits = [];
        foreach($gabarits as $gabarit){
            $select_gabarits[$gabarit->id] = $gabarit->nom;
        }
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/Event.edit', ['event' => $event, 'products' => $products, 'select_gabarits' => $select_gabarits,'select' => $select, 'select_products' => $select_products, 'select_couleurs' => $select_couleurs]);
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
        if (request('actual_nom') == request('nom')){
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'annonceur' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lieu' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);

            $event->nom = $request->nom;
            $event->annonceur = $request->annonceur;
            $event->customer_id = $request->customer_id;
            $event->save();
            $event->product_id = $request->product_id;
            $event->users()->sync($request->get('users_list'));
            $event->lieu = $request->lieu;
            $event->type = $request->type;
            $event->date = $request->date;
            $event->description = $request->description;

            
            $event->save();

            if ($request->hasFile('image')){
                $logoName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $logoName);
                $event->logoName = $logoName;
            } 

            if ($request->hasFile('BAT')){
                $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
                request()->BAT->move(public_path('uploads'), $BAT_name);
                $event->BAT_name = $BAT_name;
            } 

        $event->save();
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'annonceur' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lieu' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);

            $event->nom = $request->nom;
            $event->annonceur = $request->annonceur;
            $event->customer_id = $request->customer_id;
            $event->save();
            $event->product_id = $request->product_id;
            $event->users()->sync($request->get('users_list'));
            $event->lieu = $request->lieu;
            $event->type = $request->type;
            $event->date = $request->date;
            $event->description = $request->description;

            
            $event->save();

            if ($request->hasFile('image')){
                $logoName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $logoName);
                $event->logoName = $logoName;
            } 

            if ($request->hasFile('BAT')){
                $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
                request()->BAT->move(public_path('uploads'), $BAT_name);
                $event->BAT_name = $BAT_name;
            } 
        $event->save();
        }
        return redirect('admin/Event/index');
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

        $event->delete();
        return redirect('admin/Event/index');
    }
}
