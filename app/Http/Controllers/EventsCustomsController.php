<?php

namespace App\Http\Controllers;

use DB;
use App\Events_customs;
use App\Product;
use App\Events_products;
use App\Templates;
use App\Template_components;
use App\Printzones;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function create($id)
    {
        $events_customs = Events_customs::all();
        $events_product = Events_products::find($id);
        $product = Product::find($events_product->product_id);
        $printzones = Printzones::all();
        $templates = Templates::all();
        $select_templates = [];
        foreach($templates as $template) {
            $select_templates[$template->id] = $template->title;
        }
        $select_printzones = [];
        if($product->printzones_id != null) {
            foreach($printzones as $printzone) {
                foreach($product->printzones_id as $printzone_id) {
                    if($printzone_id == $printzone->id) {
                        $select_printzones[$printzone->id] = $printzone->zone;
                    }
                }
            }
        }
        return view('admin/EventsCustoms.add', ['select_printzones' => $select_printzones, 'templates' => $templates, 'select_templates' => $select_templates, 'product' => $product, 'events_customs' => $events_customs, 'events_product' => $events_product]);
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
            'title' => 'required|string|max:255'
        ]);
        $events_custom = new Events_customs;
        $events_custom->title = $request->title;
        $events_custom->event_id = $request->get('event_id');
        $events_custom->events_product_id = $request->get('events_product_id');
        $events_custom->events_product_variants_ids = $request->get('event_product_variants_ids');
        $events_custom->template = array(
            $request->template_id,
            $request->printzone_id,
        );
        $events_custom->title = $request->title;
        if ($request->hasFile('thumb')){
            $photo1 = time().'.'.request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('uploads'), $photo1);
            $events_custom->thumb = $photo1;
        }
        if ($request->hasFile('image')){
            $thumb_name = time().'.1'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('uploads'), $thumb_name);
            $events_custom->image = $thumb_name;
        }
        $events_custom->comments = $request->comments;
        $events_custom->is_active = $request->is_active;
        $events_custom->is_deleted = $request->is_deleted;
        $events_custom->save();
        return redirect('admin/Event/show/'.$events_custom->event_id);
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
        $events_custom = Events_customs::find($id);
        $templates = Templates::all();
        $template_components = Template_components::all();
        $select_templates = [];
        foreach($templates as $template) {
            $select_templates[$template->id] = $template->title;
        }
        if($events_custom->events_product_id != null){
            $events_product = Events_products::find($events_custom->events_product_id);
        }
        $product = Product::find($events_product->product_id);
        $printzones = Printzones::all();
        $select_printzones = [];
        if($product->printzones_id != null){
            foreach($printzones as $printzone){
                foreach($product->printzones_id as $printzone_id){
                    if($printzone_id == $printzone->id) {
                        $select_printzones[$printzone->id] = $printzone->zone;
                    }
                }
            }
        }
        return view('admin/EventsCustoms.edit', ['template_components' => $template_components, 'templates' => $templates, 'events_custom' => $events_custom, 'select_printzones' => $select_printzones, 'select_templates' => $select_templates, 'events_product' => $events_product]);
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
                'title' => 'string|max:255'
            ]);
            $events_custom_id = $request->events_custom_id;
            $events_custom = Events_customs::find($events_custom_id);
            $events_custom->position = array(
                'width' => $request->width,
                'height' => $request->height,
                'origin_x' => $request->origin_x,
                'origin_y' => $request->origin_y
            );
            $templates = Templates::all();
            $template_components = Templates_components::all();
            $options = array(
                'template_component_id' => $request->template_component_id,
                'title' => $request->option_title,
                'position' => $request->option_position,
                'settings' => array(
                    'input_min' => $request->min,
                    'input_max' => $request->max,
                    'font_first_letter' => $request->font_first_letter,
                    'font_transform' => $request->font_transform,
                    'font_weight' => $request->font_weight,
                    'fonts' => array(
                        'title' => $request->font_title,
                        'font_url' => $request->font_url
                    ),
                ),
            );
            foreach($templates as $template){
                if($template->id == $events_custom->template["template_id"]){
                    foreach($template->components_ids as $component){
                        foreach($template_components as $template_component){
                            if($template_component->id == $component){
                                if($template_component->type = 'input'){
                                    $array = $events_custom->template;
                                    array_push($array, $options);
                                }
                                else{
                                    $array = $events_custom->template;
                                    array_push($array, $options);
                                }
                            }
                        }
                    }
                }
            }
            if ($request->hasFile('thumb')){
                $photo1 = time().'.'.request()->thumb->getClientOriginalExtension();
                request()->thumb->move(public_path('uploads'), $photo1);
                $events_custom->thumb = $photo1;
            }
            if ($request->hasFile('image')){
                $thumb_name = time().'.1'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $thumb_name);
                $events_custom->image = $photo;
            }
            $events_custom->comments = $request->comments;
            $events_custom->is_active = $request->is_active;
            $events_custom->is_deleted = $request->is_deleted;
            $events_custom->save();
            return redirect('admin/Event/show/'.$events_custom->event_id);
        }
        else {
            $validatedData = $request->validate([
                'title' => 'string|max:255'
            ]);
            // dd($request->events_custom_id);
            $templates = Templates::all();
            $template_components = Template_components::all();
            $events_custom_id = $request->events_custom_id;
            $events_custom = Events_customs::find($events_custom_id);
            $events_custom->title = $request->title;
            $events_custom->position = array(
                'width' => $request->width,
                'height' => $request->height,
                'origin_x' => $request->origin_x,
                'origin_y' => $request->origin_y
            );
            // while($request->template_component_id){
            //     $events_custom->templates = array(
            //         'template_component_id' =>$request->template_component_id,
            //         'title' => $request->option_title,
            //         'position' => $request->option_position,
            //         'settings' => array(
            //             'input_min' => $request->min,
            //             'input_max' => $request->max,
            //             'font_first_letter' => $request->font_first_letter,
            //             'font_transform' => $request->font_transform,
            //             'font_weight' => $request->font_weight,
            //             'fonts' => array(
            //                 'title' => $request->font_title,
            //                 'font_url' => $request->font_url
            //             ),
            //         ),
            //     );
            // }
            if ($request->hasFile('thumb')){
                $photo1 = time().'.'.request()->thumb->getClientOriginalExtension();
                request()->thumb->move(public_path('uploads'), $photo1);
                $events_custom->thumb = $photo1;
            }
            if ($request->hasFile('image')){
                $thumb_name = time().'.1'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $thumb_name);
                $events_custom->image = $photo;
            }
            $events_custom->comments = $request->comments;
            $events_custom->is_active = $request->is_active;
            $events_custom->is_deleted = $request->is_deleted;
            $events_custom->save();
            return redirect('admin/Event/show/'.$events_custom->event_id);
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
        //
    }
}

