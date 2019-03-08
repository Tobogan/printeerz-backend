<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Event;
use App\Events_products;
use App\Products_variants;
use App\Printzones;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class EventsProductsController extends Controller
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
        $events_products = Events_products::all();
        return view('admin/EventsProducts.index', ['events_products' => $events_products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events_products = Events_products::all();
        $products = Product::all();
        return view('admin/EventsProducts.add', ['events_products' => $events_products, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'product_id' => 'required|string|max:255'
            ]);
            $events_product = new Events_products;
            $events_product->event_id = $request->event_id;
            $events_product->product_id = $request->product_id;
            $product = Product::find($events_product->product_id);
            $events_product->title = $product->title;
            $events_product->variants = array();
            $events_product->description = $request->description;
            $events_product->is_active = $request->is_active;
            $events_product->is_deleted = $request->is_deleted;
            $events_product->save();
            $response = array(
                'status' => 'success',
                'msg' => 'EventsProduct created successfully',
                'events_product' => $events_product
            );
            return response()->json($response);
        }
        else {
            return 'no';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addVarianteEP(Request $request)
    {
        if($request->ajax()) {
            if ($request->actual_titleEP == $request->title){
                $validatedData = $request->validate([
                    'products_variant_id' => 'required|string|max:255'
                ]);
                $id = $request->events_product_id;
                $events_product = Events_products::find($id);
                $variants = array(
                    $request->products_variant_id,
                    $request->quantity
                );
                $array = $events_product->variants;
                array_push($array, $variants);
                $events_product->variants = $array;
                $events_product->save();
                $response = array(
                    'status' => 'success',
                    'msg' => 'EventsProduct created successfully',
                    'events_product' => $events_product
                );
                return response()->json($response);
            }
            else {
                $validatedData = $request->validate([
                    'products_variant_id' => 'required|string|max:255'
                ]);
                $id = $request->events_product_id;
                $events_product = Events_products::find($id);
                $events_product->title == $request->title;
                $variants = array(
                    $request->products_variant_id,
                    $request->quantity
                );
                $array = $events_product->variants;
                array_push($array, $variants);
                $events_product->variants = $array;
                $events_product->save();
                $response = array(
                    'status' => 'success',
                    'msg' => 'EventsProduct created successfully',
                    'events_product' => $events_product
                );
                return response()->json($response);
            }
        }
        else {
            return 'no';
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteVariant($id, $products_variant_id)
    {
        $events_product = Events_products::find($id);
        //dd($products_variant_id);
        $array = $events_product->variants;
        foreach($events_product->variants as $variant) {
            foreach($variant as $value) {
                if($value == $products_variant_id) {
                    //dd($value);
                    unset($value);
                }
            }
        }
        //unset($to_delete);
        // foreach($events_product->variants as $variant) {
        //     $array_delete = array_search($toDelete, $variant);

        //     }
        // }

        $events_products = Events_products::all();
        $products_variants = Products_variants::all();
        $printzones = Printzones::all();
        $product = Product::find($events_product->product_id);
        return view('admin/EventsProducts.show', ['printzones' => $printzones, 'products_variants' => $products_variants, 'product' => $product, 'events_product' => $events_product, 'events_products' => $events_products]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $events_product = Events_products::find($id);
        $events_products = Events_products::all();
        $products_variants = Products_variants::all();
        $printzones = Printzones::all();
        $product = Product::find($events_product->product_id);
        return view('admin/EventsProducts.show', ['printzones' => $printzones, 'products_variants' => $products_variants, 'product' => $product, 'events_product' => $events_product, 'events_products' => $events_products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events_product = Events_products::find($id);
        return view('admin/EventsProducts.edit', ['events_products' => $events_products]);
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
        if (request('actual_title') == request('title')){
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'product_id' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->events_product_id;
            $events_product = Events_products::find($id);
            $events_product->title = $request->title;
            $events_product->product_id = $request->product_id;
            $events_product->price = $request->price;
            $events_product->description = $request->description;
    
            $events_product->variants = array(
                'id' => $request->vendor_id, 
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity
            );
    
            $events_product->customs = array(
                'id' => $request->custom_id,
                'event_customs_id' => $request->event_customs_id,
                'variants_id' => $request->variants_id,
                'quantity' => $request->quantity
            );
            $events_product->position = $request->position;
            $events_product->is_active = $request->is_active;
            $events_product->is_deleted = $request->is_deleted;
            $events_product->save();
            $events_products = Events_products::all();
            return view('admin/EventsProducts.index', ['events_products' => $events_products]);
        }

        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'product_id' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->events_product_id;
            $events_product = Events_products::find($id);
            $events_product->title = $request->title;
            $events_product->product_id = $request->product_id;
            $events_product->price = $request->price;
            $events_product->description = $request->description;
    
            $events_product->variants = array(
                'id' => $request->vendor_id, 
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity
            );
            $events_product->customs = array(
                'id' => $request->custom_id,
                'event_customs_id' => $request->event_customs_id,
                'variants_id' => $request->variants_id,
                'quantity' => $request->quantity
            );
            $events_product->position = $request->position;
            $events_product->is_active = $request->is_active;
            $events_product->is_deleted = $request->is_deleted;
            $events_product->save();
            $events_products = Events_products::all();
            return view('admin/EventsProducts.index', ['events_products' => $events_products]);
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
        $events_product = Events_products::find($id);
        $events_product->delete();
        $event = Event::find($events_product->event_id);
        $products = Product::all();
        $events_products = Events_products::all();
        $select_products = [];
        foreach($products as $product) {
            $select_products[$product->id] = $product->title;
        }
        return view('admin/Event.show', ['select_products' => $select_products, 'events_products' => $events_products, 'products' => $products, 'event' => $event]);
    }

    /*--~~~~~~~~~~~___________activate and desactivate a events$events_product function in index events$events_product__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $events_product = Events_products::find($id);
        $events_product->is_active = false;
        $events_product->update();
        return redirect('admin/EventsProducts/index')->with('status', 'Le produit a été correctement désactivée.');
    }

    public function delete($id)
    {
        $events_product = Events_products::find($id);
        $events_product->is_deleted = true;
        $events_product->update();
        $event = Event::find($events_product->event_id);
        $products = Product::all();
        $events_products = Events_products::all();
        $select_products = [];
        foreach($products as $product) {
            $select_products[$product->id] = $product->title;
        }
        return view('admin/Event.show', ['select_products' => $select_products, 'events_products' => $events_products, 'products' => $products, 'event' => $event]);    
    }

    public function activate($id)
    {
        $events_product = Events_products::find($id);
        $events_product->is_active = true;
        $events_product->update();
        $event = Event::find($events_product->event_id);
        $products = Product::all();
        $events_products = Events_products::all();
        $select_products = [];
        foreach($products as $product) {
            $select_products[$product->id] = $product->title;
        }
        return view('admin/Event.show', ['select_products' => $select_products, 'events_products' => $events_products, 'products' => $products, 'event' => $event]);    
    }
}
