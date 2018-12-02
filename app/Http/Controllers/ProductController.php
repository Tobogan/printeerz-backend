<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Taille;
use App\Zone;
use App\Couleur;
use App\ImageZone;
use App\Gabarit;
use App\ProductVariants;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class ProductController extends Controller
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
        $products = Product::all();
        $tailles = Taille::all();
        $couleurs = Couleur::all();
        
        return view('admin/Product.index', ['products' => $products, 'tailles' => $tailles, 'couleurs' => $couleurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/Product.add', ['products' => $products, 'select_couleurs' => $select_couleurs]);
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
            'reference' => 'required|string|max:255',
            'description' => 'max:750'
            // 'photo_illustration' => 'photo_illustration|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $product = new Product;
        
        $product->nom = $request->nom;
        $product->reference = $request->reference;
        $product->description = $request->description;
        $product->sexe = $request->sexe;
        $product->save();
        $product->tailles()->sync($request->get('tailles_list'));

        /*~~~~~~~~~~~___________Photo Illustration__________~~~~~~~~~~~~*/
        if ($request->hasFile('photo_illustration')){
            $photo_illustration = time().'.'.request()->photo_illustration->getClientOriginalExtension();
            request()->photo_illustration->move(public_path('uploads'), $photo_illustration);

            $product->photo_illustration = $photo_illustration;
        }
        $product->save();
        // $product = Product::find($id);
        $productVariants = ProductVariants::all();
        return view('admin/Product.show',['productVariants' => $productVariants, 'product' => $product, 'id' => $product->id])->with('status', 'Le produit a été correctement ajouté.');    
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $productVariants = ProductVariants::all();
        $couleurs = Couleur::all();
        
        return view('admin/Product.show', ['product' => $product, 'couleurs' => $couleurs, 'productVariants' => $productVariants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $products = Product::all();
        $zones = Zone::all();
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }

        return view('admin/Product.edit', ['product' => $product, 'zones' => $zones, 'couleurs' => $couleurs, 'select_couleurs' => $select_couleurs]);
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
                'reference' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $product = Product::find($id);
            $product->nom = $request->nom;
            $product->reference = $request->reference;
            $product->description = $request->description;
            $product->sexe = $request->sexe;

            $product->save();
            $product->tailles()->sync($request->get('tailles_list'));

            $product->save();
            }        
            else{
                $validatedData = $request->validate([
                    'nom' => 'required|string|max:255',
                    'reference' => 'required|string|max:255',
                    'description' => 'max:750'
                ]);
        
                $id = $request->id;
                
                $product = Product::find($id);
                $product->nom = $request->nom;
            $product->reference = $request->reference;
            $product->description = $request->description;
            $product->sexe = $request->sexe;

            $product->save();
            $product->tailles()->sync($request->get('tailles_list'));
            $product->couleurs()->sync($request->get('couleurs_list'));
            $product->zones()->sync($request->get('zones_list'));

            $product->save();
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
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/Product/index')->with('status', 'Le produit a été correctement supprimé.');
    }
}