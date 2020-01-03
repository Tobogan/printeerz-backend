<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Products_variants;
use App\Printzones;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

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
        $disk = Storage::disk('s3');
        return view('admin/Product.index', [
            'products' => $products, 
            'disk' => $disk
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin/Product.add', [
            'products' => $products
            ]
        );
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
            'title' => 'required|string|unique:products|max:255',
            'gender' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'printzones_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:4000',
            'description' => 'nullable|string|min:3|max:750',
            'vendor_reference' => 'nullable|string|max:255',
            'vendor_name' => 'nullable|string|max:255'
        ]);
        $product = new Product;
        $product->title = $request->title;
        $product->created_by = Auth::user()->username;
        $product->vendor = array(
            'name' => $request->vendor_name,
            'reference' => $request->vendor_reference
        );
        $product->gender = $request->gender;
        $product->product_type = $request->product_type;
        $product->printzones_id = $request->get('printzones_id');
        $product->description = $request->description;
        $product->is_active = $request->is_active;
        $product->is_deleted = $request->is_deleted;
        $product->save();
        $disk = Storage::disk('s3');
        if ($request->hasFile('image')) {
            // Get file
            $file = $request->file('image');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = 'products/'. $product->id . '/'. $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->widen(1080)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            // Put in database
            $product->image = $filePath;
            $product->imagePath = 'products/'. $product->id . '/';
            $product->imageName = $name;
        }
        $product->save();
        $notification = array(
            'status' => 'Le produit a été correctement ajouté',
            'alert-type' => 'success'
        );
        return redirect('admin/Product/show/' . $product->id)->with($notification);
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
        $products_variants = Products_variants::all();
        $printzones = Printzones::all();
        $disk = Storage::disk('s3');
        return view('admin/Product.show', [
            'printzones' => $printzones,
            'product' => $product, 
            'products_variants' => $products_variants, 
            'disk' => $disk
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
        $product = Product::find($id);
        $products = Product::all();        
        $disk = Storage::disk('s3');
        return view('admin/Product.edit', [
            'disk' => $disk, 
            'product' => $product, 
            'products' => $products
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
    public function update(Request $request) {
        if (request('actual_title') == request('title') || request('actual_title') !== request('title')) {
            if (request('actual_title') == request('title')) {
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'gender' => 'required|string|max:255',
                    'product_type' => 'required|string|max:255',
                    'printzones_id' => 'required',
                    'image' => 'required|image|mimes:jpeg,jpg,png|max:4000',
                    'description' => 'nullable|string|min:3|max:750',
                    'vendor_reference' => 'nullable|string|max:255',
                    'vendor_name' => 'nullable|string|max:255'
                ]);
            }
            else {
                $validatedData = $request->validate([
                    'title' => 'required|string|unique:products|max:255',
                    'gender' => 'required|string|max:255',
                    'product_type' => 'required|string|max:255',
                    'printzones_id' => 'required',
                    'image' => 'required|image|mimes:jpeg,jpg,png|max:4000',
                    'description' => 'nullable|string|min:3|max:750',
                    'vendor_reference' => 'nullable|string|max:255',
                    'vendor_name' => 'nullable|string|max:255'
                ]);
            }
            $id = $request->product_id;
            $product = Product::find($id);
            if (request('actual_title') !== request('title')) {
                $product->title = $request->title;
            }
            $product->vendor = array(
                'name' => $request->vendor_name,
                'reference' => $request->vendor_reference
            );
            $product->gender = $request->gender;
            $product->product_type = $request->product_type;
            $product->printzones_id = $request->get('printzones_id');
            $product->tag = $request->get('tags');
            $product->description = $request->description;
            $product->variants_id=$request->get('variants_id');
            $product->is_active = $request->is_active;
            $product->is_deleted = $request->is_deleted;
            if ($request->hasFile('image')) {
                $disk = Storage::disk('s3');
                $oldPath = $product->image;
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = 'products/' . $product->id . '/'. $name;
                $img = Image::make(file_get_contents($file))->widen(1080)->save($name);
                $disk->put($newFilePath, $img, 'public');
                $product->image = $newFilePath;
                $product->imagePath = '/products/'. $product->id . '/';
                $product->imageName = $name;
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                if(!empty($product->image) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            $product->update();
        }
        $notification = array(
            'status' => 'Le produit a été correctement modifié.',
            'alert-type' => 'success'
        );
        return redirect('admin/Product/show/' . $product->id)->with($notification);
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
        $disk = Storage::disk('s3');
        $filePath = $product->image;
        if(!empty($product->image) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }
        // ici j'efface les products_variants enfant ce produit
        $products_variants = Products_variants::all();
        foreach($products_variants as $products_variant) {
            if($products_variant->product_id == $product->id) {
                $products_variant->delete();
            }
        }
        $product->delete();
        $notification = array(
            'status' => 'Le produit a été correctement supprimé',
            'alert-type' => 'success'
        );
        return redirect('admin/Product/index')->with($notification);
    }

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