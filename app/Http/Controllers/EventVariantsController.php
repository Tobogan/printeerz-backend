<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Event;
use App\EventVariants;
use App\Productvariants;
use App\Taille;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class EventVariantsController extends Controller
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
        $couleurs = Couleur::all();
        return view('admin/Couleur.index', ['couleurs' => $couleurs, 'tailles' => $tailles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $products = Product::all();
        $productvariants = Productvariants::all();
        $tailles = Taille::all();
        $event = Event::find($id);
        $select_couleurs = [];
        foreach($products as $product){
            $select_products[$product->id] = $product->nom;
        }
        return view('admin/EventVariants.add', ['tailles' => $tailles, 'productvariants' => $productvariants, 'products' => $products, 'select_couleurs' => $select_products, 'event_id' => $id]);
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
            'event_id' => 'required|integer|max:255'
        ]);

        $eventVariant = new EventVariants;
        $eventVariant->event_id = $request->event_id;
        $eventVariant->product_id = $request->product_id;
        $eventVariant->save();
        $eventVariant->productvariants()->sync($request->get('variant_id'));
        // $eventVariant->tailles()->sync($request->get('taille_id'));
        $eventVariant->save();

        $event = Event::find($eventVariant->event_id);
        $eventVariants = EventVariants::all();
        return view('admin/Event.show',['eventVariants' => $eventVariants, 'event' => $event, 'id' => $event->id])->with('status', 'Le produit a été correctement ajoutée à l\'événement.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eventVariant = EventVariants::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productVariant = Productvariants::find($id);
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/Productvariants.edit', ['couleurs' => $couleurs, 'select_couleurs' => $select_couleurs]);
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
        if (request('actual_color') == request('color')){
            $validatedData = $request->validate([
                'color' => 'required|string|max:255',
                'zone1' => 'required|string|max:255',
                'zone2' => 'required|string|max:255',
                'zone3' => 'required|string|max:255',
                'zone4' => 'required|string|max:255',
                'zone5' => 'required|string|max:255',
                'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $id = $request->id;
            $productVariant = Productvariants::find($id);
            
            $productVariant->color = $request->color;
            $productVariant->product_id = $request->product_id;
    
            $productVariant->zone1 = $request->zone1;
            $productVariant->zone2 = $request->zone2;
            $productVariant->zone3 = $request->zone3;
            $productVariant->zone4 = $request->zone4;
            $productVariant->zone5 = $request->zone5;
            
            $productVariant->image1 = $request->image1;
            $productVariant->image2 = $request->image2;
            $productVariant->image3 = $request->image3;
            $productVariant->image4 = $request->image4;
            $productVariant->image5 = $request->image5;
    
            $productVariant->save();
            }        
            else{
                $validatedData = $request->validate([
                    'color' => 'required|string|max:255',
                    'zone1' => 'required|string|max:255',
                    'zone2' => 'required|string|max:255',
                    'zone3' => 'required|string|max:255',
                    'zone4' => 'required|string|max:255',
                    'zone5' => 'required|string|max:255',
                    'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                $id = $request->id;
                $productVariant = Productvariants::find($id);
                
                $productVariant->color = $request->color;
                $productVariant->product_id = $request->product_id;
        
                $productVariant->zone1 = $request->zone1;
                $productVariant->zone2 = $request->zone2;
                $productVariant->zone3 = $request->zone3;
                $productVariant->zone4 = $request->zone4;
                $productVariant->zone5 = $request->zone5;
                
                $productVariant->image1 = $request->image1;
                $productVariant->image2 = $request->image2;
                $productVariant->image3 = $request->image3;
                $productVariant->image4 = $request->image4;
                $productVariant->image5 = $request->image5;
        
                $productVariant->save();
        }
            return redirect('admin/Product/index')->with('status', 'Le produit a été correctement modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventVariant = EventVariants::find($id);

        if($eventVariant != NULL){
            $eventVariant->delete();
            $event = Event::find($eventVariant->event_id);
            $eventVariants = EventVariants::all();
            return view('admin/Event.show',['eventVariants' => $eventVariants, 'event' => $event, 'id' => $event->id])->with('status', 'La variante a été correctement supprimée.');
        }
        else {
            return redirect('admin/Event/index');
        }
    }
}
