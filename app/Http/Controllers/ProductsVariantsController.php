<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Products_variants;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse; 

class ProductsVariantsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_variants = Products_variants::all();
        return view('admin/ProductsVariants.add', ['products_variants' => $products_variants]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'color' => 'string|max:255',
                'size' => 'string|max:255',
                'quantity' => 'string|max:255',
                'position' => 'string|max:255',
                'description' => 'max:750'
            ]);
            $input_size = $request->size;
            $sizes = explode(",", $input_size);
            $input_color = $request->color;
            $products_variants = array();
            $colors = explode(",",$input_color);
            foreach($colors as $color) {
                foreach($sizes as $size) {
                    $products_variants = new Products_variants;
                    /*$products_variants->vendor = array(
                        'sku' => $request->vendor_sku,
                        'quantity' => $request->vendor_quantity
                    );*/
                    $products_variants->size = $size;
                    $products_variants->product_id = $request->product_id;
                    $products_variants->color = $color;
                    $products_variants->is_active = $request->is_active;
                    $products_variants->is_deleted = $request->is_deleted;
                    $products_variants->save();
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => 'Variant created successfully',
                'products_variants' => $products_variants,
                'colors' => $colors
            );
            return response()->json($response);
        }
        else {
            return 'no';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products_variants = Products_variants::find($id);
        return view('admin/ProductsVariants.edit', ['products_variants' => $products_variants]);
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
        if (request('actual_name') == request('name')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'color' => 'required|string|max:255',
                'size' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            
            $products_variants = new Products_variants;
            $products_variants->name = $request->name;
            $products_variants->vendor = array(
                'sku' => $request->vendor_sku,
                'quantity' => $request->vendor_quantity
            );
            $products_variants->product_id = $request->product_id;
            $products_variants->color = $request->color;
            $products_variants->size = $request->size;
            $products_variants->quantity = $request->quantity;
            $products_variants->position = $request->position;
            $products_variants->product_zones = array(
                'id' => $request->product_zone_id,
                'title' => $request->product_zone_title,
                'image' => $request->product_zone_image
            );
            $products_variants->is_active = $request->is_active; //penser à mettre l'input hidden
            $products_variants->is_deleted = $request->is_deleted;
            $products_variants->save();
            
            if ($request->hasFile('image')){
                $file_path_image = public_path('uploads/'.$products_variants->image);
                if(file_exists(public_path('uploads/'.$products_variants->image)) && !empty($products_variants->image)){
                    unlink($file_path_image);
                }
                $photo = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $photo);
                $products_variants->image = $photo;
            }
            $products_variants->save();
            $product = Product::find($products_variants->product_id);
            return view('admin/Product.show',['product' => $product, 'id' => $products_variants->product_id])->with('status', 'La variante a bien été correctement modifiée.');
        }

        else {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'color' => 'required|string|max:255',
                'size' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            
            $products_variants = new Products_variants;
            $products_variants->name = $request->name;
            $products_variants->vendor = array(
                'sku' => $request->vendor_sku,
                'quantity' => $request->vendor_quantity
            );
            $products_variants->product_id = $request->product_id;
            $products_variants->color = $request->color;
            $products_variants->size = $request->size;
            $products_variants->quantity = $request->quantity;
            $products_variants->position = $request->position;
            $products_variants->product_zones = array(
                'id' => $request->product_zone_id,
                'title' => $request->product_zone_title,
                'image' => $request->product_zone_image
            );
            $products_variants->is_active = $request->is_active; //penser à mettre l'input hidden
            $products_variants->is_deleted = $request->is_deleted;
            $products_variants->save();
            
            if ($request->hasFile('image')){
                $file_path_image = public_path('uploads/'.$products_variants->image);
                if(file_exists(public_path('uploads/'.$products_variants->image)) && !empty($products_variants->image)){
                    unlink($file_path_image);
                }
                $photo = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $photo);
                $products_variants->image = $photo;
            }
            $products_variants->save();
            $product = Product::find($products_variants->product_id);
            return view('admin/Product.show',['product' => $product, 'id' => $products_variants->product_id])->with('status', 'La variante a bien été correctement modifiée.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products_variants = Products_variants::find($id);
        $file_path_image = public_path('uploads/'.$products_variants->image);
        if(file_exists(public_path('uploads/'.$products_variants->image)) && !empty($products_variants->image)){
            unlink($file_path_image);
        }
        $products_variants->delete();
        $product = Product::find($products_variants->product_id);
        $products_variants = Products_variants::all();
        return view('admin/Product.show', ['product' => $product, 'products_variants' => $products_variants])->with('status', 'Le variante a été correctement supprimé.');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a products_variants function in index products_variants__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_active = false;
        $products_variants->update();
        return redirect('admin/ProductsVariants/index')->with('status', 'Le variante a été correctement supprimé.');
    }

    public function delete($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_deleted = true;
        $products_variants->update();
        return redirect('admin/ProductsVariants/index')->with('status', 'Le variante a été correctement désactivée.');
    }

    public function activate($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_active = true;
        $products_variants->update();
        return redirect('admin/ProductsVariants/index')->with('status', 'Le variante a été correctement activée.');
    }
}