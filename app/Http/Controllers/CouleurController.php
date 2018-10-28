<?php

namespace App\Http\Controllers;

use DB;
use App\Couleur;
use App\Customer;
use App\Taille;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class CouleurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couleurs = Couleur::all();
        $tailles = Taille::all();
        return view('admin/Couleur.index', ['couleurs' => $couleurs, 'tailles' => $tailles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $couleurs = Couleur::all();
        return view('admin/Couleur.add', ['couleurs' => $couleurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin()
    {
        $couleurs = Couleur::all();
        return view('admin/Couleur.add', ['couleurs' => $couleurs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request){
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255'
    
            ]);
            $couleur = new Couleur;
            $couleur->nom = $request->nom;

            if ($request->hasFile('pantone')){
                $pantoneName = time().'.'.request()->pantone->getClientOriginalExtension();
                request()->pantone->move(public_path('uploads'), $pantoneName);
    
                $couleur->pantoneName = $pantoneName;
            }
            
            $couleur->save();
            //return redirect('admin/Couleur/index')->with('status', 'La couleur a été correctement ajouté.');
            
            $response = array(
                'status' => 'success',
                'msg' => 'Setting created successfully',
                'couleur' => $couleur
            );
            return response()->json($response);
        } 
        else{
            return 'no';
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(Request $request)
    {
        if($request){
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255'
    
            ]);
            $couleur = new Couleur;
            $couleur->nom = $request->nom;

            if ($request->hasFile('pantone')){
                $pantoneName = time().'.'.request()->pantone->getClientOriginalExtension();
                request()->pantone->move(public_path('uploads'), $pantoneName);
    
                $couleur->pantoneName = $pantoneName;
            }
            
            $couleur->save();
            return redirect('admin/Couleur/index')->with('status', 'La couleur a été correctement ajoutée.');
            
            // $response = array(
            //     'status' => 'success',
            //     'msg' => 'Setting created successfully',
            //     'couleur' => $couleur
            // );
            // return response()->json($response);
        } 
        else{
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
        $couleur = Couleur::find($id);
        return view('admin/Couleur.show', ['couleur' => $couleur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $couleur = Couleur::find($id);
        return view('admin/Couleur.edit', ['couleur' => $couleur]);
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
            $couleur = Couleur::find($id);
            $couleur->nom = $request->nom;
            if ($request->hasFile('pantone')){
                $pantoneName = time().'.'.request()->pantone->getClientOriginalExtension();
                request()->pantone->move(public_path('uploads'), $pantoneName);
    
                $couleur->pantoneName = $pantoneName;
            }
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255'
    
            ]);
            $id = $request->id;
            $couleur = Couleur::find($id);
            $couleur->nom = $request->nom;
            if ($request->hasFile('pantone')){
                $pantoneName = time().'.'.request()->pantone->getClientOriginalExtension();
                request()->pantone->move(public_path('uploads'), $pantoneName);
    
                $couleur->pantoneName = $pantoneName;
            }
        }
        $couleur->save();
        return redirect('admin/Couleur/index')->with('status', 'La couleur a été correctement modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $couleur = Couleur::find($id);
        $couleur->delete();
        return redirect('admin/Couleur/index')->with('status', 'La couleur a été correctement supprimée.');
    }
}
