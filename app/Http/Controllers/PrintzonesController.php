<?php

namespace App\Http\Controllers;

use DB;
use App\Printzones;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

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
        return view('admin/Printzones.index', ['printzones' => $printzones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $printzones = Printzones::all();
        return view('admin/Printzones.add', ['printzones' => $printzones]);
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
            'name' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
            'width' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            'description' => 'max:750'
        ]);
        
        $printzone = new Printzones;

        $printzone->name = $request->name;
        $printzone->zone = $request->zone;
        $printzone->printer_id = $request->printer_id;
        $printzone->width = $request->width;
        $printzone->height = $request->height;
        $printzone->origin_x = $request->origin_x;
        $printzone->origin_y = $request->origin_y;
        $printzone->tray_width = $request->tray_width;
        $printzone->tray_height = $request->tray_height;
        $printzone->is_active = $request->is_active;
        $printzone->is_deleted = $request->is_deleted;
        $printzone->description = $request->description;

        $printzone->save();

        return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement créee.');
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
        return view('admin/Printzones.show', ['printzone' => $printzone]);
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
        return view('admin/Printzones.edit', ['printzone' => $printzone]);
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
                'description' => 'max:750'
            ]);
            
            $id = $request->id;
            $printzone = Printzones::find($id);
    
            $printzone->name = $request->name;
            $printzone->zone = $request->zone;
            $printzone->printer_id = $request->printer_id;
            $printzone->width = $request->width;
            $printzone->height = $request->height;
            $printzone->origin_x = $request->origin_x;
            $printzone->origin_y = $request->origin_y;
            $printzone->tray_width = $request->tray_width;
            $printzone->tray_height = $request->tray_height;
            $printzone->is_active = $request->is_active;
            $printzone->is_deleted = $request->is_deleted;
            $printzone->description = $request->description;
    
            $printzone->save();
    
            return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement modifié.');
        }

        else {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'zone' => 'required|string|max:255',
                'width' => 'required|string|max:255',
                'height' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            
            $id = $request->id;
            $printzone = Printzones::find($id);
    
            $printzone->name = $request->name;
            $printzone->zone = $request->zone;
            $printzone->printer_id = $request->printer_id;
            $printzone->width = $request->width;
            $printzone->height = $request->height;
            $printzone->origin_x = $request->origin_x;
            $printzone->origin_y = $request->origin_y;
            $printzone->tray_width = $request->tray_width;
            $printzone->tray_height = $request->tray_height;
            $printzone->is_active = $request->is_active;
            $printzone->is_deleted = $request->is_deleted;
            $printzone->description = $request->description;
    
            $printzone->save();
    
            return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement modifié.');
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
        $printzone = Printzones::find($id);
        $printzone->delete();
        return redirect('admin/Printzones/index')->with('status', 'La zone d\impression ont été correctement supprimée.');

    }

    /*--~~~~~~~~~~~___________activate and desactivate a printzone function in index printzone__________~~~~~~~~~~~~-*/
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
