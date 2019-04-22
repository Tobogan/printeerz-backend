<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Products_variants;
use App\Printzones;

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
            ]);
            $input_size = $request->size;
            $sizes = explode(",", $input_size);
            $input_color = $request->color;
            $products_variant = array();
            $colors = explode(",",$input_color);
            foreach($colors as $color) {
                foreach($sizes as $size) {
                    $products_variant = new Products_variants;
                    $products_variant->size = $size;
                    $products_variant->product_id = $request->product_id;
                    $products_variant->color = $color;
                    $products_variant->is_active = $request->is_active;
                    $products_variant->is_deleted = $request->is_deleted;
                    $products_variant->save();
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => 'Variant created successfully',
                'products_variant' => $products_variant,
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
        $products_variant = Products_variants::find($id);
        $products_variants = Products_variants::all();
        return view('admin/Product.show', ['products_variant' => $product, 'products_variants' => $products_variants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products_variant = Products_variants::find($id);
        $printzones = Printzones::all();
        $product = Product::find($products_variant->product_id);
        return view('admin/ProductsVariants.edit', ['product' => $product, 'printzones' => $printzones,'products_variant' => $products_variant]);
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
                'size' => 'required|string|max:255',
                'quantity' => 'required|string|max:255'
            ]);
            $pv_id = $request->products_variant_id;
            $products_variant = Products_variants::find($pv_id);
            $products_variant->vendor = array(
                'sku' => $request->vendor_sku,
                'quantity' => $request->vendor_quantity
            );
            $products_variant->quantity = $request->quantity;
            //  $products_variant->position = $request->position;
            $products_variant->save();
            $printzones_nb = $request->printzones_nb;
            if($request->printzone1) {
                for($i=1; $i<$printzones_nb;$i++){
                    if ($request->hasFile('printzone'.$i)){
                        //dd($request->{'printzone'.$i});
                        if(isset($products_variant->{'printzone'.$i}['image'])){
                            $file_path_image = public_path('uploads/'.$products_variant->{'printzone'.$i}['image']);
                            if(file_exists(public_path('uploads/'.$products_variant->{'printzone'.$i}['image']))){
                                unlink($file_path_image);
                            }
                        }
                        $request_img =  $request->{'printzone'.$i};
                        $request_id =  $request->{'printzone_id_'.$i};
                        $request_name =  $request->{'printzone_name_'.$i};
                        $img = time().$i.'.'.$request_img->getClientOriginalExtension();
                        //dd($request_img);
                        $request_img->move(public_path('uploads'), $img);
                    }
                    $products_variant->{'printzone'.$i} = array(
                        'id' => $request_id,
                        'title' => $request_name,
                        'image' => $img
                    );
                }
            }
            
            if ($request->hasFile('image')){
                $file_path_image = public_path('uploads/'.$products_variant->image);
                if(file_exists(public_path('uploads/'.$products_variant->image)) && !empty($products_variant->image)){
                    unlink($file_path_image);
                }
                $photo = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $photo);
                $products_variant->image = $photo;
            }
            $products_variant->save();
            $products_variants = Products_variants::all();
            $product = Product::find($products_variant->product_id);
            $printzones = Printzones::all();
            return redirect('admin/Product/show/'.$product->id)->with('status', 'La variante a bien été correctement modifiée.');
         }
        else {
            $validatedData = $request->validate([
                'color' => 'required|string|max:255',
                'size' => 'required|string|max:255',
                'quantity' => 'required|string|max:255'
            ]);
            $pv_id = $request->products_variant_id;
            $products_variant = Products_variants::find($pv_id);
            $products_variant->vendor = array(
                'sku' => $request->vendor_sku,
                'quantity' => $request->vendor_quantity
            );
            $products_variant->quantity = $request->quantity;
            //  $products_variant->position = $request->position;
            $products_variant->save();
            $printzones_nb = $request->printzones_nb;
            if($request->printzone1) {
                for($i=1; $i<$printzones_nb;$i++){
                    if ($request->hasFile('printzone'.$i)){
                        //dd($request->{'printzone'.$i});
                        if(isset($products_variant->{'printzone'.$i}['image'])){
                            $file_path_image = public_path('uploads/'.$products_variant->{'printzone'.$i}['image']);
                            if(file_exists(public_path('uploads/'.$products_variant->{'printzone'.$i}['image']))){
                                unlink($file_path_image);
                            }
                        }
                        $request_img =  $request->{'printzone'.$i};
                        $request_id =  $request->{'printzone_id_'.$i};
                        $request_name =  $request->{'printzone_name_'.$i};
                        $img = time().$i.'.'.$request_img->getClientOriginalExtension();
                        //dd($request_img);
                        $request_img->move(public_path('uploads'), $img);
                    }
                    $products_variant->{'printzone'.$i} = array(
                        'id' => $request_id,
                        'title' => $request_name,
                        'image' => $img
                    );
                }
            }
            
            if ($request->hasFile('image')){
                $file_path_image = public_path('uploads/'.$products_variant->image);
                if(file_exists(public_path('uploads/'.$products_variant->image)) && !empty($products_variant->image)){
                    unlink($file_path_image);
                }
                $photo = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $photo);
                $products_variant->image = $photo;
            }
            $products_variant->save();
            $products_variants = Products_variants::all();
            $product = Product::find($products_variant->product_id);
            $printzones = Printzones::all();
            return view('admin/Product.show',['printzones' => $printzones,'products_variants' => $products_variants, 'product' => $product, 'id' => $products_variant->product_id])->with('status', 'La variante a bien été correctement modifiée.');
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
        $notification = array(
            'status' => 'La variante a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Product/show/'.$products_variants->product_id)->with($notification);
    }

    public function desactivate($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_active = false;
        $products_variants->update();
        $notification = array(
            'status' => 'La variante a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/ProductsVariants/index')->with($notification);
    }

    public function delete($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_deleted = true;
        $products_variants->update();$notification = array(
            'status' => 'La variante a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/ProductsVariants/index')->with($notification);
    }

    public function activate($id)
    {
        $products_variants = Products_variants::find($id);
        $products_variants->is_active = true;
        $products_variants->update();
        $notification = array(
            'status' => 'La variante a été correctement activée.',
            'alert-type' => 'success'
        );
        return redirect('admin/ProductsVariants/index')->with($notification);
    }
}