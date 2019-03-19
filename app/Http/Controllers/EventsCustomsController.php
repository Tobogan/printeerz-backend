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
        return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addColor(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'events_custom_id' => 'required|string|max:255'
            ]);
            $id = $request->events_custom_id;
            $events_custom = Events_customs::find($id);
            $color = array(
                'title' => $request->color,
                'code_hex' => $request->code_hex
            );
            $array = $events_custom->components["font_colors"];
            array_push($array, $color);
            $events_custom->components["font_colors"] = $array;
            $events_custom->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Events custom created successfully',
                'events_custom' => $events_custom
            );
            return response()->json($response);
        }
        else {
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
            $events_custom->components = array(
                array(
                    'template_component_id' =>$request->template_component_id1,
                    'title' => $request->option_title1,
                    'position' => $request->option_position1,
                    'settings' => array(
                        'input_min' => $request->min1,
                        'input_max' => $request->max1,
                        'font_first_letter' => $request->font_first_letter1,
                        'font_transform' => $request->font_transform1,
                        'font_weight' => $request->font_weight1,
                        'fonts' => array(
                            'title' => $request->font_title1,
                            'font_url' => $request->font_url1
                        ),
                        'font_colors' => array(
                            'title' => $request->color1,
                            'code_hex' => $request->code_hex1
                        ),
                    ),
                ),
                array(
                    'template_component_id' =>$request->template_component_id2,
                    'title' => $request->option_title2,
                    'position' => $request->option_position2,
                    'settings' => array(
                        'input_min' => $request->min2,
                        'input_max' => $request->max2,
                        'font_first_letter' => $request->font_first_letter2,
                        'font_transform' => $request->font_transform2,
                        'font_weight' => $request->font_weight2,
                        'fonts' => array(
                            'title' => $request->font_title2,
                            'font_url' => $request->font_url2
                        ),
                        'font_colors' => array(
                            'title' => $request->color2,
                            'code_hex' => $request->code_hex2
                        ),
                    ),
                ),
                array(
                    'template_component_id' =>$request->template_component_id3,
                    'title' => $request->option_title3,
                    'position' => $request->option_position3,
                    'settings' => array(
                        'input_min' => $request->min3,
                        'input_max' => $request->max3,
                        'font_first_letter' => $request->font_first_letter3,
                        'font_transform' => $request->font_transform3,
                        'font_weight' => $request->font_weight3,
                        'fonts' => array(
                            'title' => $request->font_title3,
                            'font_url' => $request->font_url3
                        ),
                        'font_colors' => array(
                            'title' => $request->color3,
                            'code_hex' => $request->code_hex3
                        ),
                    ),
                ),
            );  
            
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
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
        }
        else {
            $validatedData = $request->validate([
                'title' => 'string|max:255'
            ]);
            $events_custom_id = $request->events_custom_id;
            $events_custom = Events_customs::find($events_custom_id);
            $events_custom->title = $request->title;
            $events_custom->position = array(
                'width' => $request->width,
                'height' => $request->height,
                'origin_x' => $request->origin_x,
                'origin_y' => $request->origin_y
            );
            $events_custom->components = array(
                array(
                    'template_component_id' =>$request->template_component_id1,
                    'title' => $request->option_title1,
                    'position' => $request->option_position1,
                    'settings' => array(
                        'input_min' => $request->min1,
                        'input_max' => $request->max1,
                        'font_first_letter' => $request->font_first_letter1,
                        'font_transform' => $request->font_transform1,
                        'font_weight' => $request->font_weight1,
                        'fonts' => array(
                            'title' => $request->font_title1,
                            'font_url' => $request->font_url1
                        ),
                        'font_colors' => array(
                            'title' => $request->color1,
                            'code_hex' => $request->code_hex1
                        ),
                    ),
                ),
                array(
                    'template_component_id' =>$request->template_component_id2,
                    'title' => $request->option_title2,
                    'position' => $request->option_position2,
                    'settings' => array(
                        'input_min' => $request->min2,
                        'input_max' => $request->max2,
                        'font_first_letter' => $request->font_first_letter2,
                        'font_transform' => $request->font_transform2,
                        'font_weight' => $request->font_weight2,
                        'fonts' => array(
                            'title' => $request->font_title2,
                            'font_url' => $request->font_url2
                        ),
                        'font_colors' => array(
                            'title' => $request->color2,
                            'code_hex' => $request->code_hex2
                        ),
                    ),
                ),
                array(
                    'template_component_id' =>$request->template_component_id3,
                    'title' => $request->option_title3,
                    'position' => $request->option_position3,
                    'settings' => array(
                        'input_min' => $request->min3,
                        'input_max' => $request->max3,
                        'font_first_letter' => $request->font_first_letter3,
                        'font_transform' => $request->font_transform3,
                        'font_weight' => $request->font_weight3,
                        'fonts' => array(
                            'title' => $request->font_title3,
                            'font_url' => $request->font_url3
                        ),
                        'font_colors' => array(
                            'title' => $request->color3,
                            'code_hex' => $request->code_hex3
                        ),
                    ),
                ),
            ); 

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
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
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
        $events_custom = Events_customs::find($id);
        $events_custom->delete();
        return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
    }

        /*--~~~~~~~~~~~___________activate and desactivate a events$events_product function in index events$events_product__________~~~~~~~~~~~~-*/
        public function desactivate($id)
        {
            $events_custom = Events_customs::find($id);
            $events_custom->is_active = false;
            $events_custom->update();
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
        }
    
        public function delete($id)
        {
            $events_custom = Events_customs::find($id);
            $events_custom->is_deleted = true;
            $events_custom->update();
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
        }
    
        public function activate($id)
        {
            $events_custom = Events_customs::find($id);
            $events_custom->is_active = true;
            $events_custom->update();
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
        }
}

