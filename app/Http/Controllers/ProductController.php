<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Products_variants;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class ProductController extends Controller
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
        $products = Product::all();
        return view('admin/Product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin/Product.add', ['products' => $products]);
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
            'gender' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'description' => 'max:750'
        ]);
        
        $product = new Product;
        
        $product->title = $request->title;
        $product->vendor = array(
            'id' => $request->vendor_id,    // gros doute là dessus @Jo voir avec lui
            'name' => $request->vendor_name,
            'reference' => $request->vendor_reference
        );
        $product->gender = $request->gender;
        $product->product_type = $request->product_type;
        $product->product_zones = array(
            'id' => $request->product_zone_id,    // gros doute là dessus @Jo voir avec lui
            'title' => $request->product_zone_title,
            'printzone_id' => $request->product_zone_printzone_id
        );
        $tags[]=$request->get('tags');
        $product->tags=$tags;
        $product->description = $request->description;
        $variants_id[]=$request->get('variants_id');
        $product->variants_id=$variants_id;
        $product->is_active = $request->is_active; //penser à mettre l'input hidden
        $product->is_deleted = $request->is_deleted;
        $product->save();

        /*~~~~~~~~~~~___________Photo Illustration__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $photo = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads'), $photo);

            $product->image = $photo;
        }

        $product->save();
        // $product = Product::find($id);
        return view('admin/Product.show',['product' => $product, 'id' => $product->id])->with('status', 'Le produit a été correctement ajouté.');    
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

        return view('admin/Product.show', ['product' => $product]);
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

        return view('admin/Product.edit', ['product' => $product, 'products' => $products]);
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
                'title' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'product_type' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            
            $id = $request->id;
            $product = Product::find($id);
            $product->title = $request->title;
            $product->vendor = array(
                'id' => $request->vendor_id,    // gros doute là dessus @Jo voir avec lui
                'name' => $request->vendor_name,
                'reference' => $request->vendor_reference
            );
            $product->gender = $request->gender;
            $product->product_type = $request->product_type;
            $product->product_zones = array(
                'id' => $request->product_zone_id,    // gros doute là dessus @Jo voir avec lui
                'title' => $request->product_zone_title,
                'printzone_id' => $request->product_zone_printzone_id
            );
            $tags[]=$request->get('tags');
            $product->tags=$tags;
            $product->description = $request->description;
            $variants_id[]=$request->get('variants_id');
            $product->variants_id=$variants_id;
            $product->is_active = $request->is_active; //penser à mettre l'input hidden
            $product->is_deleted = $request->is_deleted;
            $product->save();

            /*~~~~~~~~~~~___________Photo Illustration__________~~~~~~~~~~~~*/
            if ($request->hasFile('image')){
                if(!is_null($product->image)){
                    unlink(public_path('uploads/'.$product->image));
                }
                $photo = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $photo);

                $product->image = $photo;
            }

            $product->save();
            }        
            else{
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'gender' => 'required|string|max:255',
                    'product_type' => 'required|string|max:255',
                    'description' => 'max:750'
                ]);
        
                $id = $request->id;
                
                $product = Product::find($id);
                $product->title = $request->title;
                $product->vendor = array(
                    'id' => $request->vendor_id,    // gros doute là dessus @Jo voir avec lui
                    'name' => $request->vendor_name,
                    'reference' => $request->vendor_reference
                );
                $product->gender = $request->gender;
                $product->product_type = $request->product_type;
                $product->product_zones = array(
                    'id' => $request->product_zone_id,    // gros doute là dessus @Jo voir avec lui
                    'title' => $request->product_zone_title,
                    'printzone_id' => $request->product_zone_printzone_id
                );
                $tags[]=$request->get('tags');
                $product->tags=$tags;
                $product->description = $request->description;
                $variants_id[]=$request->get('variants_id');
                $product->variants_id=$variants_id;
                $product->is_active = $request->is_active; //penser à mettre l'input hidden
                $product->is_deleted = $request->is_deleted;
                $product->save();

                /*~~~~~~~~~~~___________Photo Illustration__________~~~~~~~~~~~~*/
                if ($request->hasFile('image')){
                    if(!is_null($product->image)){
                        unlink(public_path('uploads/'.$product->image));
                    }
                    $photo = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('uploads'), $photo);

                    $product->image = $photo;
                }

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
        if(!is_null($product->image)){
            unlink(public_path('uploads/'.$product->image));
        }
        $product->delete();
        return redirect('admin/Product/index')->with('status', 'Le produit a été correctement supprimé.');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a product function in index product__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $product = Product::find($id);
        $product->is_active = false;
        $product->update();
        return redirect('admin/Product/index');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->is_deleted = true;
        $product->update();
        return redirect('admin/Product/index');
    }

    public function activate($id)
    {
        $product = Product::find($id);
        $product->is_active = true;
        $product->update();
        return redirect('admin/Product/index');
    }
}