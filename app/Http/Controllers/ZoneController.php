<?php

namespace App\Http\Controllers;

use DB;
use App\Zone;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class ZoneController extends Controller
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
        $zones = Zone::all();
        return view('admin/Zone.index', ['zones' => $zones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::all();
        return view('admin/Zone.add', ['zones' => $zones]);
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
            'nom' => 'required|string|max:255'

        ]);
        $zone = new Zone;
        $zone->nom = $request->nom;
        if ($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $imageName);

            $zone->imageName = $imageName;
        }
        
        $zone->save();
        return view('admin/Zone.show', ['zone' => $zone]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::find($id);
        return view('admin/Zone.show', ['zone' => $zone]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::find($id);
        return view('admin/Zone.edit', ['zone' => $zone]);
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
                'nom' => 'required|string|max:255'
    
            ]);
            $id = $request->id;
            $zone = Zone::find($id);
            $zone->nom = $request->nom;
            if ($request->hasFile('image')){
                $imageName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $imageName);
    
                $zone->imageName = $imageName;
            }
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255'
    
            ]);
            $id = $request->id;
            $zone = Zone::find($id);
            $zone->nom = $request->nom;
            if ($request->hasFile('image')){
                $imageName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $imageName);
    
                $zone->imageName = $imageName;
            }
        }
        $zone->save();
        return view('admin/Zone.show', ['zone' => $zone]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::find($id);
        $zone->delete();
        return redirect('admin/Zone/index');
    }
}
