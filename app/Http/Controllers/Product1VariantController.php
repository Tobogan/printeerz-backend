<?php

use DB;
use App\Product;
use App\Taille;
use App\Zone;
use App\Couleur;
use App\ImageZone;
use App\Gabarit;
use App\ProductVariant;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class ProductVariantController extends Controller
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
        // pas d'index pour les variants, tout sera avec le product
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productsVariants = ProductVariant::all();
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/ProductVariant.add', [ 'select_couleurs' => $select_couleurs]);
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
        $productVariant = new ProductVariant;
        
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productVariant = ProductVariant::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productVariant = ProductVariant::find($id);
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/ProductVariant.edit', ['couleurs' => $couleurs, 'select_couleurs' => $select_couleurs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            $productVariant = ProductVariant::find($id);
            
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
                $productVariant = ProductVariant::find($id);
                
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
        $productVariant = ProductVariant::find($id);
        $productVariant->delete();
        return redirect('admin/Product/index')->with('status', 'La variant de produit a été correctement supprimée.');
    }
}