<?php

namespace App\Http\Controllers;

use App\Couleur;
use App\Event;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $couleurs = Couleur::all();
        return $event->toJson();
        //return view('front.show', ['event' => $event, 'couleurs' => $couleurs]);
    }

}