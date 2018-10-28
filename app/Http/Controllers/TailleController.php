<?php

namespace App\Http\Controllers;

use DB;
use App\Event;
use App\Taille;
use App\Couleur;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class TailleController extends Controller
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
        $couleurs = Couleur::all();
        $tailles = Taille::all();
        return view('admin/Couleur.index', ['tailles' => $tailles, 'couleurs' => $couleurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tailles = Taille::all();
        return view('admin/Taille.add', ['tailles' => $tailles]);
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
        $taille = new Taille;
        $taille->nom = $request->nom;
        
        $taille->save();
        return redirect('admin/Taille/index')->with('status', 'La taille a été correctement ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taille = Taille::find($id);
        return view('admin/Taille.show', ['taille' => $taille]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taille = Taille::find($id);
        return view('admin/Taille.edit', ['taille' => $taille]);
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
            $taille = Taille::find($id);
            $taille->nom = $request->nom;
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255'
    
            ]);
            $id = $request->id;
            $taille = Taille::find($id);
            $taille->nom = $request->nom;
        }
        $taille->save();
        return redirect('admin/Taille/index')->with('status', 'La taille a été correctement modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taille = Taille::find($id);
        $taille->delete();
        return redirect('admin/Taille/index')->with('status', 'La taille a été correctement supprimé.');
    }
}
