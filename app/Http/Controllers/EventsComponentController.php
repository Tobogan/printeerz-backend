<?php

namespace App\Http\Controllers;

use DB;
use App\Events_component;

use Illuminate\Http\Request;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

class EventsComponentController extends Controller
{
    public function __construct(){
        //$this->middleware(isActivate::class);
        //$this->middleware(isAdmin::class);
        $this->middleware('auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events_component = Events_component::find($id);
        $events_component->delete();
    }
}
