<?php

namespace App\Http\Controllers;

use DB;
use App\Events_customs;

use Illuminate\Http\Request;

class EventsCustomsController extends Controller
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
        $events_customs = Events_customs::all();
        return view('admin/Events_customs.index', ['events_customs' => $events_customs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events_customs = Events_customs::all();
        return view('admin/Events_customs.add', ['events_customs' => $events_customs]);
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
            'title' => 'required|string|max:255',
            'comments' => 'max:750'
        ]);
        
        $events_customs = new Events_customs;
        
        $event_product_ids[]=$request->get('event_product_ids');
        $events_customs->event_product_ids=$event_product_ids;

        $event_product_variants_ids[]=$request->get('event_product_variants_ids');
        $events_customs->event_product_variants_ids=$event_product_variants_ids;

        $events_customs->position = array(
            'width' => $request->width,
            'height' => $request->height,
            'origin_x' => $request->origin_x,
            'origin_y' => $request->origin_y
        );

        $events_customs->template = array(
            'id' => $request->template_id,
            'options' => array(
                'template_component_id' => $request->template_component_id,
                'title' => $request->option_title,
                'position' => $request->option_position,
                'settings' => array(
                    'input_min' => $request->setting_input_min,
                    'input_max' => $request->setting_input_max,
                    'fonts' => array(
                        'title' => $request->font_title,
                        'font_url' => $request->font_url
                    ),
                ),
            ),    // tu viens de finir cette partie et on est le 15/01  
        );

        $events_customs->title = $request->title;
        
        if ($request->hasFile('thumb')){
            $photo = time().'.'.request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('uploads'), $photo);

            $events_customs->thumb = $photo;
        }

        if ($request->hasFile('image')){
            $thumb_name = time().'.1'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads'), $thumb_name);

            $events_customs->image = $photo;
        }

        $events_customs->comments = $request->comments;
        $events_customs->is_active = $request->is_active;
        $events_customs->is_deleted = $request->is_deleted;

        $events_customs->save();
        return view('admin/Events_customs.show',['events_customs' => $events_customs, 'id' => $events_customs->id])->with('status', 'Le produit a été correctement ajouté.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
