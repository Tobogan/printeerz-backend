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

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
        $events_custom->colors = array();
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
   /*public function addColor(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'events_custom_id' => 'string|max:255'
            ]);
            $events_custom_id = $request->events_custom_id;
            $events_custom = Events_customs::find($events_custom_id);
            $color = array(
                'template_component_id' => $request->tp_id,
                'title' => $request->color,
                'code_hex' => $request->code_hex
            );
            $array = $events_custom->colors;
            array_push($array, $color);
            $events_custom->colors = $array;
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
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function delete($events_custom_id, $string)
    {
        function removeElement($array,$value) {
            if (($key = array_search($value, $array)) !== false) {
              unset($array[$key]);
            }
           return $array;
        }
        $events_custom = Events_customs::find($events_custom_id);
        foreach($events_custom->variants as $variant) {
            foreach($variant as $value) {
                if($value == $string) {
                    $variant_to_delete = $variant;
                }
            }
        }
        $result = removeElement($events_custom->variants, $variant_to_delete);
        $arr = $events_custom->variants;
        $arr = $result;
        $events_custom->variants = $arr;
        $events_custom->save();
        return redirect('admin/EventsProducts/show/'.$events_custom->id);
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $events_custom = Events_customs::find($id);
        $events_customs = Events_customs::all();
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
        return view('admin/EventsCustoms.show', ['events_customs' => $events_customs,'template_components' => $template_components, 'templates' => $templates, 'events_custom' => $events_custom, 'select_printzones' => $select_printzones, 'select_templates' => $select_templates, 'events_product' => $events_product]);
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
            $events_custom->title = $request->title;
            $events_custom->components = array();

            for($i=1;$i<6;$i++){
                $template_component_id= $request->{'template_component_id'.$i};
                if($request->{'template_component_id'.$i}){
                    $array_colors = array();
                    $colors = array();
                    foreach($request->{'colorsList'.$template_component_id} as $colcode){
                        foreach($request->{'hexaList'.$template_component_id} as $hexa){
                            $col = explode(",", $colcode);
                            $hex = explode(",", $hexa);
                        }
                    }
                    for($j=0;$j<count($col);$j++){
                        $array = array(
                            'title' => $col[$j],
                            'code_hexa' => $hex[$j]
                        );
                        array_push($array_colors, $array);
                    }
                    
                    $array_fonts = array();
                    $fonts = array();
                    foreach($request->{'fontsList'.$template_component_id} as $font_title){
                        if($request->{'url_'.$template_component_id}){
                            foreach($request->{'url_'.$template_component_id} as $font_url){
                                $font = explode(",", $font_title);
                                array_push($fonts, $font_url);
                            }
                        }

                    }
                }
                for($k=0;$k<count($font);$k++){
                    $array_ft = array(
                        'title' => $font[$k],
                        'font_url' => $fonts[$k]
                    );
                    array_push($array_fonts, $array_ft);
                }
                $component = array(
                    'template_component_id' => $request->{'template_component_id'.$i},
                    'title' => $request->{'option_title'.$i},
                    'position' => $request->{'option_position'.$i},
                    'settings' => array(
                        'input_min' => $request->{'min'.$i},
                        'input_max' => $request->{'max'.$i},
                        'font_first_letter' => $request->{'font_first_letter'.$i},
                        'font_transform' => $request->{'font_transform'.$i},
                        'font_weight' => $request->{'font_weight'.$i},
                        'fonts' => $array_fonts,
                        'font_colors' => $array_colors,
                        'position' => array(
                            'width' => $request->{'width'.$i},
                            'height' => $request->{'height'.$i},
                            'origin_x' => $request->{'origin_x'.$i},
                            'origin_y' => $request->{'origin_y'.$i}
                        ),
                    ),
                );
                $array = $events_custom->components;
                array_push($array, $component);
                $events_custom->components = $array;
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
            $events_custom->components = array();

            for($i=1;$i<6;$i++){
                $template_component_id= $request->{'template_component_id'.$i};
                if($request->{'template_component_id'.$i}){
                    $array_colors = array();
                    $colors = array();
                    foreach($request->{'colorsList'.$template_component_id} as $colcode){
                        foreach($request->{'hexaList'.$template_component_id} as $hexa){
                            $col = explode(",", $colcode);
                            $hex = explode(",", $hexa);
                        }
                    }
                    for($j=0;$j<count($col);$j++){
                        $array = array(
                            'title' => $col[$j],
                            'code_hexa' => $hex[$j]
                        );
                        array_push($array_colors, $array);
                    }
                    
                    $array_fonts = array();
                    $fonts = array();
                    foreach($request->{'fontsList'.$template_component_id} as $font_title){
                        if($request->{'url_'.$template_component_id}){
                            foreach($request->{'url_'.$template_component_id} as $font_url){
                                $font = explode(",", $font_title);
                                array_push($fonts, $font_url);
                            }
                        }
                    }
                }
                for($k=0;$k<count($font);$k++){
                    $array_ft = array(
                        'title' => $font[$k],
                        'font_url' => $fonts[$k]
                    );
                    array_push($array_fonts, $array_ft);
                }
                $component = array(
                    'template_component_id' => $request->{'template_component_id'.$i},
                    'title' => $request->{'option_title'.$i},
                    'position' => $request->{'option_position'.$i},
                    'settings' => array(
                        'input_min' => $request->{'min'.$i},
                        'input_max' => $request->{'max'.$i},
                        'font_first_letter' => $request->{'font_first_letter'.$i},
                        'font_transform' => $request->{'font_transform'.$i},
                        'font_weight' => $request->{'font_weight'.$i},
                        'fonts' => $array_fonts,
                        'font_colors' => $array_colors,
                        'position' => array(
                            'width' => $request->{'width'.$i},
                            'height' => $request->{'height'.$i},
                            'origin_x' => $request->{'origin_x'.$i},
                            'origin_y' => $request->{'origin_y'.$i}
                        ),
                    ),
                );
                $array = $events_custom->components;
                array_push($array, $component);
                $events_custom->components = $array;
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

    /**
     * Upload a new file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
    {
        if($request){
            $validatedData = $request->validate([
            ]);
            $disk = Storage::disk('s3'); 
            $title = $request->ec_font_title;
            if($request->hasFile('ec_font_url')){
                $events_custom_event_id = $request->events_custom_event_id;
                $template_component_id = $request->tp_id_font;
                // Create image name
                $font_file = $request->file('ec_font_url');
                $name = $font_file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/event/'.$events_custom_event_id.'/fonts/'.$title.'/'.$name;
                // Upload the new image
                $disk->put($newFilePath, $font_file, 'public');
                // Put in database
                $font_file = $newFilePath;
            }
            $response = array(
                'status' => 'success',
                'msg' => 'Font file send to the server',
                'font_filename' => $request->ec_font_title
            );
            return response()->json($response);
        }
        else {
            return 'no';
        }
    }
}
/*if ($request->hasFile('thumb')){
    $photo1 = time().'.'.request()->thumb->getClientOriginalExtension();
    request()->thumb->move(public_path('uploads'), $photo1);
    $events_custom->thumb = $photo1;
}*/