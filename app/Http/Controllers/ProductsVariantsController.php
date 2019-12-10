<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Products_variants;
use App\Printzones;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse; 

use Illuminate\Support\Facades\Auth;

class ProductsVariantsController extends Controller
{
    public function __construct(){
        //$this->middleware(isActivate::class);
        //$this->middleware(isAdmin::class);
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_variants = Products_variants::all();
        return view('admin/ProductsVariants.add', [
            'products_variants' => $products_variants
            ]
        );
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
            $validatedData = \Validator::make($request->all(),[
                'color' => 'required|string|max:255',
                'size' => 'required|string|max:255',
            ]);
            if ($validatedData->fails()){
                return response()->json(['errors'=>$validatedData->errors()->all()]);
            }
            else{
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
        return view('admin/Product.show', [
            'products_variant' => $product_variant, 
            'products_variants' => $products_variants
            ]
        );
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
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        return view('admin/ProductsVariants.edit', [
            's3' => $s3, 
            'disk' => $disk, 
            'product' => $product, 
            'printzones' => $printzones,
            'products_variant' => $products_variant
            ]
        );
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
        if (request('actual_color') == request('color') || request('actual_color') !== request('color')) {
            $validatedData = $request->validate([
                'color' => 'required|string|max:255',
                'size' => 'required|string|max:255',
                'quantity' => 'required|string|max:255',
                'printzone' => 'image|mimes:jpeg,jpg,png|max:4000',
                'image' => 'image|mimes:jpeg,jpg,png|max:4000'
            ]);
            $pv_id = $request->products_variant_id;
            $products_variant = Products_variants::find($pv_id);
            if (request('actual_color') !== request('color')) {
                $products_variant->color = $request->color;
            }
            $products_variant->created_by = Auth::user()->username;
            $products_variant->vendor = array(
                'sku' => $request->vendor_sku,
                'quantity' => $request->vendor_quantity
            );
            $disk = Storage::disk('s3');
            $products_variant->quantity = $request->quantity;
            $products_variant->size = $request->size;
            $printzones_nb = $request->printzones_nb;
            $printzones = array();
            for ($i = 1; $i < $printzones_nb; $i++) {
                if ($request->{'printzone' . $i}) {
                    if ($request->hasFile('printzone' . $i)) {
                        if (isset($products_variant->{'printzone' . $i}['image'])) {
                            $oldPath = $products_variant->{'printzone' . $i}['image'];
                            $file = $request->file('printzone'.$i);
                            $name = time() . $file->getClientOriginalName();
                            $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
                            if (file_exists(public_path() . '/' . $name)) {
                                unlink(public_path() . '/' . $name);
                            }
                            if (!empty($products_variant->{'printzone'.$i}['image']) && $disk->exists($newFilePath)) {
                                $disk->delete($oldPath);
                            }
                        }
                        $request_img =  $request->{'printzone'.$i};
                        $request_id =  $request->{'printzone_id_'.$i};
                        $request_name =  $request->{'printzone_name_'.$i};
                        $file = $request->file('printzone'.$i);
                        $name = time() . $file->getClientOriginalName();
                        $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
                        $img = Image::make(file_get_contents($file))->widen(1080)->save($name);
                        $disk->put($newFilePath, $img, 'public');
                        // $disk->put($newFilePath, $img, 'public');
                        if (file_exists(public_path() . '/' . $name)) {
                            unlink(public_path() . '/' . $name);
                        }
                    }
                    $printzone = array(
                        'id' => $request_id,
                        'title' => $request_name,
                        'image' => $newFilePath
                    );
                    array_push($printzones, $printzone);
                }
            }
            $products_variant->numberOfZones = $printzones_nb - 1;
            if ($request->hasFile('image')) {
                $oldPath = $products_variant->image;
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
                if (!empty($products_variant->image) && $disk->exists($newFilePath)) {
                    $disk->delete($oldPath);
                }
                $img = Image::make(file_get_contents($file))->widen(1080)->save($name);
                // $img = Image::make(file_get_contents($file));
                // $img->backup();
                // $img->resize(1080, 1920)->save($name);
                $disk->put($newFilePath, $img, 'public');
                // $img = Image::make(file_get_contents($file))->widen(300)->save($name);
                // $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                // Put in database
                $products_variant->image = $newFilePath;
            }
            if (isset($printzones) && $printzones !== null) {
                $products_variant->printzones = $printzones;
            }
            $products_variant->update();
            $product = Product::find($products_variant->product_id);
            $notification = array(
                'status' => 'La variante a été correctement modifiée.',
                'alert-type' => 'success'
            );
            return redirect('admin/Product/show/'.$product->id)->with($notification);
         }
        // else {
        //     $validatedData = $request->validate([
        //         'color' => 'required|string|max:255',
        //         'size' => 'required|string|max:255',
        //         'quantity' => 'required|string|max:255',
        //         'printzone' => 'image|mimes:jpeg,jpg,png|max:4000',
        //         'image' => 'image|mimes:jpeg,jpg,png|max:4000'
        //     ]);
        //     $pv_id = $request->products_variant_id;
        //     $products_variant = Products_variants::find($pv_id);
        //     $products_variant->color = $request->color;
        //     $products_variant->size = $request->size;
        //     $products_variant->vendor = array(
        //         'sku' => $request->vendor_sku,
        //         'quantity' => $request->vendor_quantity
        //     );
        //     $disk = Storage::disk('s3');
        //     $products_variant->quantity = $request->quantity;
        //     $printzones_nb = $request->printzones_nb;
        //     $printzones = array();
        //     if($request->printzone1) {
        //         for($i=1; $i<$printzones_nb;$i++){
        //             if ($request->hasFile('printzone'.$i)){
        //                 if(isset($products_variant->{'printzone'.$i}['image'])){
        //                     $oldPath = $products_variant->{'printzone'.$i}['image'];
        //                     $file = $request->file('printzone'.$i);
        //                     $name = time() . $file->getClientOriginalName();
        //                     $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
        //                     if(!empty($products_variant->{'printzone'.$i}['image']) && $disk->exists($newFilePath)){
        //                         $disk->delete($oldPath);
        //                     }
        //                 }
        //                 $request_img =  $request->{'printzone'.$i};
        //                 $request_id =  $request->{'printzone_id_'.$i};
        //                 $request_name =  $request->{'printzone_name_'.$i};
        //                 $file = $request->file('printzone'.$i);
        //                 $name = time() . $file->getClientOriginalName();
        //                 $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
        //                 // Resize new image
        //                 // $img = Image::make(file_get_contents($file))->widen(300)->save($name);
        //                                         $img = Image::make(file_get_contents($file))->widen(1080)->save($name);

        //                 // $img = Image::make(file_get_contents($file));
        //                 // $img->backup();
        //                 // $img->resize(1080, 1920)->save($name);
        //                 $disk->put($newFilePath, $img, 'public');

        //                 // $disk->put($newFilePath, $img, 'public');
        //                 if (file_exists(public_path() . '/' . $name)) {
        //                     unlink(public_path() . '/' . $name);
        //                 }
        //             }
        //             $printzone = array(
        //                 'id' => $request_id,
        //                 'title' => $request_name,
        //                 'image' => $newFilePath
        //             );
        //             array_push($printzones, $printzone);
        //         }
        //     }
        //     $products_variant->printzones = $printzones;
        //     $products_variant->numberOfZones = $printzones_nb - 1;
        //     if ($request->hasFile('image')){
        //          $oldPath = $products_variant->image;
        //         $file = $request->file('image');
        //         $name = time() . $file->getClientOriginalName();
        //         $newFilePath = '/products/' . $products_variant->product_id . '/variants/'.$products_variant->id.'/'. $name;
        //         if (!empty($products_variant->image) && $disk->exists($newFilePath)) {
        //             $disk->delete($oldPath);
        //         }
        //         $img = Image::make(file_get_contents($file))->widen(1080)->save($name);
        //         // $img = Image::make(file_get_contents($file));
        //         // $img->backup();
        //         // $img->resize(1080, 1920)->save($name);
        //         $disk->put($newFilePath, $img, 'public');
        //         // $img = Image::make(file_get_contents($file))->widen(300)->save($name);
        //         // $disk->put($newFilePath, $img, 'public');
        //         if (file_exists(public_path() . '/' . $name)) {
        //             unlink(public_path() . '/' . $name);
        //         }
        //         // Put in database
        //         $products_variant->image = $newFilePath;
        //     }
        //     $products_variant->save();
        //     $product = Product::find($products_variant->product_id);
        //     $notification = array(
        //         'status' => 'La variante a bien été correctement modifiée.',
        //         'alert-type' => 'success'
        //     );
        //     return redirect('admin/Product/show/'.$product->id)->with($notification);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products_variant = Products_variants::find($id);
        $disk = Storage::disk('s3');
        if(!empty($products_variant->image) && $disk->exists($products_variant->image)){
            $disk->delete($products_variant->image);
        }
        // I loop on number of printzones for delete image in server
        for($i=1; $i<=$products_variant->numberOfZones;$i++){
            if(!empty($products_variant->{'printzone'.$i}['image']) && $disk->exists($products_variant->{'printzone'.$i}['image'])){
                $disk->delete($products_variant->{'printzone'.$i}['image']);
            }
        }
        $products_variant->delete();
        $notification = array(
            'status' => 'La variante a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Product/show/'.$products_variant->product_id)->with($notification);
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