<?php

namespace App\Http\Controllers;

use DB;
use App\Printzones;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Illuminate\Support\Facades\Auth;

class PrintzonesController extends Controller
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
        $printzones = Printzones::all();
        return view('admin/Printzones.index', [
            'printzones' => $printzones
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
        $printzones = Printzones::all();
        return view('admin/Printzones.add', [
            'printzones' => $printzones
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
            'name' => 'required|string|unique:printzones|max:255',
            'zone' => 'required|string|max:255',
            'width' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            'tray_width' => 'required|string|max:255',
            'tray_height' => 'required|string|max:255',
            'description' => 'nullable|string|max:750'
        ]);
        
        $printzone = new Printzones;
        $printzone->name = $request->name;
        $printzone->created_by = Auth::user()->username;
        $printzone->zone = $request->zone;
        $printzone->printer_id = $request->printer_id;
        $printzone->width = $request->width;
        $printzone->height = $request->height;
        $printzone->origin_x = $request->origin_x;
        $printzone->origin_y = $request->origin_y;
        $printzone->tray_width = $request->tray_width;
        $printzone->tray_height = $request->tray_height;
        $printzone->alignX = $request->alignX;
        $printzone->alignY = $request->alignY;
        $printzone->positionX = $request->positionX;
        $printzone->positionY = $request->positionY;
        $printzone->ratio = $request->ratio;
        $printzone->is_active = $request->is_active;
        $printzone->is_deleted = $request->is_deleted;
        $printzone->description = $request->description;

        $printzone->save();

        $notification = array(
            'status' => 'La zone d\'impression ont été correctement créee.',
            'alert-type' => 'success'
        );
        return redirect('admin/Printzones/index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $printzone = Printzones::find($id);
        return view('admin/Printzones.show', [
            'printzone' => $printzone
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
        $printzone = Printzones::find($id);
        return view('admin/Printzones.edit', [
            'printzone' => $printzone
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
        if (request('actual_name') == request('name')){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'zone' => 'required|string|max:255',
                'width' => 'required|string|max:255',
                'height' => 'required|string|max:255',
                'tray_width' => 'required|string|max:255',
                'tray_height' => 'required|string|max:255',
                'description' => 'nullable|string|max:750'
            ]);
            
            $id = $request->printzones_id;
            $printzone = Printzones::find($id);
            $printzone->name = $request->name;
            $printzone->zone = $request->zone;
            $printzone->printer_id = $request->printer_id;
            $printzone->width = $request->width;
            $printzone->height = $request->height;
            $printzone->origin_x = $request->origin_x;
            $printzone->origin_y = $request->origin_y;
            $printzone->alignX = $request->alignX;
            $printzone->alignY = $request->alignY;
            $printzone->positionX = $request->positionX;
            $printzone->positionY = $request->positionY;
            $printzone->ratio = $request->ratio;
            $printzone->tray_width = $request->tray_width;
            $printzone->tray_height = $request->tray_height;
            $printzone->description = $request->description;
        }

        else {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'zone' => 'required|string|max:255',
                'width' => 'required|string|max:255',
                'height' => 'required|string|max:255',
                'tray_width' => 'required|string|max:255',
                'tray_height' => 'required|string|max:255',
                'description' => 'nullable|string|max:750'
            ]);
            
            $id = $request->printzones_id;
            $printzone = Printzones::find($id);
            $printzone->name = $request->name;
            $printzone->zone = $request->zone;
            $printzone->printer_id = $request->printer_id;
            $printzone->width = $request->width;
            $printzone->height = $request->height;
            $printzone->origin_x = $request->origin_x;
            $printzone->origin_y = $request->origin_y;
            $printzone->positionX = $request->positionX;
            $printzone->positionY = $request->positionY;
            $printzone->ratio = $request->ratio;
            $printzone->tray_width = $request->tray_width;
            $printzone->tray_height = $request->tray_height;
            $printzone->alignX = $request->alignX;
            $printzone->alignY = $request->alignY;
            $printzone->is_active = $request->is_active;
            $printzone->is_deleted = $request->is_deleted;
            $printzone->description = $request->description;
        }
        $printzone->save();

        $notification = array(
            'status' => 'La zone d\'impression ont été correctement modifiée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Printzones/index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::all();
        foreach($products as $product){
            foreach($product->printzones_id as $key => $value){
                if($id == $value){
                    $notification = array(
                        'status' => 'Vous ne pouvez pas supprimer cette zone car elle est utilisée pour le produit : '.$product->title,
                        'alert-type' => 'danger'
                    );
                    return redirect('admin/Printzones/index')->with($notification);
                }
                else{
                    $printzone = Printzones::find($id);
                    $printzone->delete();
                    $notification = array(
                        'status' => 'La zone d\'impression ont été correctement supprimée.',
                        'alert-type' => 'success'
                    );
                    return redirect('admin/Printzones/index')->with($notification);
                }
            }
        }
        $printzone = Printzones::find($id);
        $printzone->delete();
        $notification = array(
            'status' => 'La zone d\'impression ont été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Printzones/index')->with($notification);
    }

    // activate and desactivate a printzone function in index printzone
    public function desactivate($id)
    {
        $printzone = Printzones::find($id);
        $printzone->is_active = false;
        $printzone->update();
        return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement désactivée.');
    }

    public function delete($id)
    {
        $printzone = Printzones::find($id);
        $printzone->is_deleted = true;
        $printzone->update();
        return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement effacée.');
    }

    public function activate($id)
    {
        $printzone = Printzones::find($id);
        $printzone->is_active = true;
        $printzone->update();
        return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement activée.');
    }
}
