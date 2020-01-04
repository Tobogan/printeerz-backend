<?php

namespace App\Http\Controllers;

use DB;
use App\Events_customs;
use App\Events_component;
use App\Product;
use App\Event;
use App\Events_products;
use App\Templates;
use App\Template_components;
use App\Products_variants;
use App\Printzones;
use App\Font;

use Illuminate\Http\Request;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

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
        return view('admin/Events_customs.index', [
            'events_customs' => $events_customs
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function create($id) {
        $events_customs = Events_customs::all();
        $events_product = Events_products::find($id);
        $event = Event::find($events_product->event_id);
        $product = Product::find($events_product->product_id);
        $printzones = Printzones::all();
        $templates = Templates::all();
        $select_templates = [];
        foreach ($templates as $template) {
            $select_templates[$template->id] = $template->title;
        }
        $select_printzones = [];
        if ($product->printzones_id != null) {
            foreach ($printzones as $printzone) {
                foreach ($product->printzones_id as $printzone_id) {
                    if ($printzone_id == $printzone->id) {
                        $select_printzones[$printzone->id] = $printzone->zone;
                    }
                }
            }
        }
        $variant_colors = [];
        $colors = [];
        $ids = [];
        if ($events_product->variants != null) {
            foreach ($events_product->variants as $variant) {
                $products_variant = Products_variants::find($variant['products_variant_id']);
                $colors[$products_variant->color] = $products_variant->color;
            }
        }
        // Delete all duplicated colors
        $variant_colors = array_unique($colors);
        return view('admin/EventsCustoms.add', [
            'event' => $event, 
            'select_printzones' => $select_printzones, 
            'templates' => $templates, 
            'select_templates' => $select_templates, 
            'product' => $product, 
            'events_customs' => $events_customs, 
            'events_product' => $events_product,
            'variant_colors' => $variant_colors
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'custom_img' => 'required|image|mimes:jpeg,jpg,png|max:4000'
        ]);
        $disk = Storage::disk('s3');
        $events_custom = new Events_customs;
        $events_custom->created_by = Auth::user()->username;
        $events_custom->title = $request->title;
        $events_custom->save();
        if ($request->hasFile('custom_img')) {
            $file = $request->file('custom_img');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'events/'. $request->get('event_id') . '/'. $events_custom->id . '/'. $name;
            $img = Image::make(file_get_contents($file))->widen(300)->save($name);
            $disk->put($filePath, $img, 'public');
            $events_custom->imageUrl = $filePath;
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
        }
        $events_custom->event_id = $request->get('event_id');
        $events_custom->events_product_id = $request->get('events_product_id');
        $events_custom->printzone_id = $request->printzone_id;
        $events_custom->template_id = $request->template_id;
        // $events_custom->template_title = $template->title;
        $events_custom->products_variant_color = $request->products_variant_id;
        $events_custom->is_active = true;
        $events_custom->is_deleted = false;
        $events_custom->save();
        // here I push the id in the corresponding events_product
        $events_product = Events_products::find($events_custom->events_product_id);
        $arr_events_customs = $events_product->event_customs_ids;
        array_push($arr_events_customs, $events_custom->id);
        $events_product->event_customs_ids = array_slice($arr_events_customs, 0);
        $events_product->update();
        // Add events_component for every component in the template selected for the events_custom
        $templates = Templates::all();
        foreach ($templates as $template) {
            if ($template->id == $request->template_id) {
                $template_selected = $template;
            }
        }
        $template_components = Template_components::all();
        $components = array();
        foreach ($template_selected->components_ids as $component) {
            foreach ($template_components as $template_component) {
                if ($component['id'] == $template_component->id ) {
                    $events_component = new Events_component;
                    $events_component->title = $template_component->title;
                    $events_component->events_custom_id =  $events_custom->id;
                    $events_component->template_component_id =  $template_component->id;
                    $events_component->type = $template_component->comp_type;
                    $events_component->event_id = $request->event_id;
                    $events_component->events_product_id = $request->events_product_id;
                    $events_component->template_id = $request->template_id;
                    $events_component->printzone_id = $request->printzone_id;
                    $events_component->width = $template_component->size['width'];
                    $events_component->height = $template_component->size['height'];
                    $events_component->origin_x =  $template_component->origin['x'];
                    $events_component->origin_y = $template_component->origin['y'];
                    $events_component->input_min = $template_component->characters['min'];
                    $events_component->input_max = $template_component->characters['max'];
                    $events_component->highlight = $template_component->highlight;
                    $events_component->save();
                    array_push($components, $events_component->id);
                }
            }
        }
        $events_custom->components_ids = $components;
        $events_custom->save();
        return redirect('admin/EventsCustoms/edit/'.$events_custom->id);
    }

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
        $events_components = Events_component::all();
        $disk = Storage::disk('s3');
        $select_templates = [];
        foreach($templates as $template) {
            $select_templates[$template->id] = $template->title;
        }
        if($events_custom->events_product_id != null){
            $events_product = Events_products::find($events_custom->events_product_id);
        }
        $product = Product::find($events_product->product_id);
        $printzones = Printzones::all();
        $font_transform = [
            'none'=>'Aucune',
            'uppercase'=>'Tout en Majuscules',
            'capitalize'=>'Première lettre en Majuscule',
            'lowercase'=>'Tout en minuscule',
            'full-width'=>'Pleine largeur'
        ];
        $font_weight = [
            '100'=>'Thin (100)',
            '200'=>'Extra Light (200)',
            '300'=>'Light (300)',
            '400'=>'Normal (400)',
            '500'=>'Medium (500)',
            '600'=>'Semi Bold (600)',
            '700'=>'Bold (700)',
            '800'=>'Extra Bold (800)',
            '900'=>'Black (900)'
        ];
        $fonts = Font::all();
        $select_fonts = [];
        foreach ($fonts as $font) {
            $select_fonts[$font->id] = $font->title;
        }
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
        return view('admin/EventsCustoms.show', [
            'select_fonts' => $select_fonts, 
            'events_components'=> $events_components,
            'disk' => $disk,
            'font_weight' => $font_weight,
            'font_transform' => $font_transform,
            'events_customs' => $events_customs,
            'template_components' => $template_components, 
            'templates' => $templates, 
            'events_custom' => $events_custom, 
            'select_printzones' => $select_printzones,
            'select_templates' => $select_templates, 
            'events_product' => $events_product
            ]
        );
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
        $template = Templates::find($events_custom->template_id);
        $fonts = Font::all();
        $template_components = Template_components::all();
        $disk = Storage::disk('s3');
        $select_templates = [];
        foreach ($templates as $template) {
            $select_templates[$template->id] = $template->title;
        }
        if ($events_custom->events_product_id != null) {
            $events_product = Events_products::find($events_custom->events_product_id);
        }
        $product = Product::find($events_product->product_id);
        $printzones = Printzones::all();
        $events_components = Events_component::all();
        $fonts = Font::all();
        $select_fonts = [];
        foreach ($fonts as $font) {
            $select_fonts[$font->id] = $font->title;
        }
        $select_printzones = [];
        if ($product->printzones_id != null) {
            foreach ($printzones as $printzone) {
                foreach ($product->printzones_id as $printzone_id) {
                    if ($printzone_id == $printzone->id) {
                        $select_printzones[$printzone->id] = $printzone->zone;
                    }
                }
            }
        }
        $components = array();
        foreach ($events_custom->components_ids as $component_id) {
            foreach ($events_components as $events_component) {
                if ($component_id == $events_component->id) {
                    array_push($components, $events_component);
                }
            }
        }
        return view('admin/EventsCustoms.edit', [
            'select_fonts' => $select_fonts, 
            'events_components' => $events_components,
            'disk' => $disk,
            'components' => $components,
            'events_custom' => $events_custom,
            'select_printzones' => $select_printzones, 
            'select_templates' => $select_templates, 
            'events_product' => $events_product,
            'template' => $template
            ]
        );
    }

    public function removeElement($array,$element) {
        if (($key = array_search($element, $array)) !== false) {
            unset($array[$key]);
        }
        $arr = array();
        foreach ($array as $key => $value) {
            array_push($arr, $value);
        }
        return array_filter($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        if (request('actual_title') == request('title') || request('actual_title') !== request('title')) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'color' => 'string|max:500',
                'code_hex' => 'string|max:500',
                'comp_image' => 'image|mimes:jpeg,jpg,png|max:4000',
                'custom_img' => 'image|mimes:jpeg,jpg,png|max:4000',
                'smode_text_color_hex' => 'string|max:255',
                'smode_bg_color_hex' => 'string|max:255',
                'align' => 'string|max:255',
                'group' => 'string|max:255',
                'fullwidth' => 'string|max:255'
            ]);
            $disk = Storage::disk('s3');
            $events_custom = Events_customs::find($request->events_custom_id);
            if (request('actual_title') !== request('title')) {
                $events_custom->title = $request->title;
            }
            $events_custom->description = $request->description;
            $count_component = $request->countJS;
            if ($request->hasFile('custom_img')) {
                $oldPath = $events_custom->imageUrl;
                $file = $request->file('custom_img');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = 'events/'. $events_custom->event_id . '/'. $events_custom->id . '/'. $name;
                $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
                $disk->put($newFilePath, $img, 'public');
                $events_custom->imageUrl = $newFilePath;
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                if (!empty($events_custom->imageUrl) && $disk->exists($newFilePath)) {
                    $disk->delete($oldPath);
                }
            }
            for ($i = 0; $i <= $count_component; $i++) {
                $ec_id = $request->{'template_component_id' . $i};
                $events_component = Events_component::find($ec_id);
                if ($ec_id != null) {
                    if ($events_component->type == 'input') {
                        $array_colors = array();
                        if ($request->{'colorsList' . $ec_id}[0] !== null) {
                            foreach ($request->{'colorsList' . $ec_id} as $colcode) {
                                foreach ($request->{'hexaList' . $ec_id} as $hexa) {
                                    $col = explode(",", $colcode);
                                    $hex = explode(",", $hexa);
                                }
                            }
                            $col_filtered = array_filter($col);
                            $hex_filtered = array_filter($hex);
                            $colors_titles = array_slice($col_filtered, 0);
                            $hex_titles = array_slice($hex_filtered, 0);
                            for ($j = 0; $j < count($colors_titles); $j++) {
                                $array = array(
                                    'title' => $colors_titles[$j],
                                    'code_hexa' => $hex_titles[$j]
                                );
                                array_push($array_colors, $array);
                            }
                        }
                        else if ($request->{'colorsList' . $ec_id}[0] == null && $request->{'smodeColorsList' . $ec_id}[0] == null){
                            $alert = array(
                                'status' => 'Merci d\'ajouter une couleur pour chacun des composants "texte".',
                                'alert-type' => 'danger'
                            );
                            return redirect()->back()->with($alert);
                        }
                        // SMODE Colors & Background colors
                        $array_smode_colors = array();
                        if ($request->{'smodeColorsList' . $ec_id}[0] !== null ) {
                            foreach ($request->{'smodeColorsList' . $ec_id} as $colcode) {
                                foreach ($request->{'smodeHexaList' . $ec_id} as $hexa) {
                                    foreach ($request->{'smodeBgHexaList' . $ec_id} as $bghexa) {
                                        foreach ($request->{'smodeBgColorsList' . $ec_id} as $bgcolcode) {
                                            $col = explode(",", $colcode);
                                            $hex = explode(",", $hexa);
                                            $bgcol = explode(",", $bgcolcode);
                                            $bghex = explode(",", $bghexa);
                                        }
                                    }
                                }
                            }
                            $col_filtered = array_filter($col);
                            $hex_filtered = array_filter($hex);
                            $bg_col_filtered = array_filter($bgcol);
                            $bg_hex_filtered = array_filter($bghex);
                            $bg_colors_titles = array_slice($bg_col_filtered, 0);
                            $bg_hex_titles = array_slice($bg_hex_filtered, 0);
                            $colors_titles = array_slice($col_filtered, 0);
                            $hex_titles = array_slice($hex_filtered, 0);
                            for ($j = 0; $j < count($colors_titles); $j++) {
                                $array = array(
                                    'title' => $colors_titles[$j],
                                    'code_hexa' => $hex_titles[$j],
                                    'bg_title' => $bg_colors_titles[$j],
                                    'bg_code_hexa' => $bg_hex_titles[$j]
                                );
                                array_push($array_smode_colors, $array);
                            }
                        }
                      
                        $array_fonts = array();
                        $fonts = array();
                        if ($request->{'fontsList' . $ec_id}[0] !== null ) {
                            foreach (array_filter($request->{'fontsList' . $ec_id}) as $font_title) {
                                $font = explode(",", $font_title);
                            }
                        }
                        else {
                            $alert = array(
                                'status' => 'Merci d\'ajouter une police pour chacun des composants "texte".',
                                'alert-type' => 'danger'
                            );
                            return redirect()->back()->with($alert);
                        }
                        if ($font[0] == "") {
                            $shift = array_shift($font);
                        }
                        $arr_ids = array();
                        $arr_urls = array();
                        $arr_filenames = array();
                        $fonts_all = Font::all();
                        $array_fonts_weight = array();
                        $fonts_weight = array();
                        foreach ($request->{'fontsWeightList' . $ec_id} as $font_weight) {
                            foreach ($request->{'fontsTransformList' . $ec_id} as $font_transform) {
                                $fonts_weight_exploded = explode(",", $font_weight);
                                $fonts_transform_exploded = explode(",", $font_transform);
                                array_push($fonts_weight, $fonts_transform_exploded);
                            }
                        }
                        if ($fonts_weight_exploded[0] == "") {
                            $shifted_weight = array_shift($fonts_weight_exploded);
                            $shifted_transform = array_shift($fonts_transform_exploded);
                        }
                        foreach (array_filter($font) as $ft) {
                            foreach ($fonts_all as $font_obj) {
                                if ($font_obj->title == $ft) {
                                    foreach ($fonts_weight_exploded as $weight) {
                                        if ($weight == 'default') {
                                            array_push($array_fonts_weight, $font_obj->weight);
                                        }
                                        else {
                                            array_push($array_fonts_weight, $weight);
                                        }
                                    }
                                }
                            }
                            break;
                        }
                        foreach (array_filter($font) as $ft) {
                            foreach ($fonts_all as $font_obj) {
                                if ($font_obj->title == $ft) {
                                    array_push($arr_ids, $font_obj->id);
                                    array_push($arr_urls, $font_obj->url);
                                    array_push($arr_filenames, $font_obj->file_name);
                                    break;
                                }
                            }
                        }
                        for ($k=0; $k<count(array_filter($font)); $k++) {
                            if ($font[$k] !== null) {
                                $array_ft = array(
                                    'title' => $font[$k],
                                    'font_id' => $arr_ids[$k],
                                    'font_file_name' => $arr_filenames[$k],
                                    'font_weight' => $array_fonts_weight[$k],
                                    'font_transform' => $fonts_transform_exploded[$k],
                                    'font_url' => $arr_urls[$k]
                                );
                                array_push($array_fonts, $array_ft);
                            }
                        }
                        $component_input = [
                            'id' => $request->{'template_component_id' . $i},
                            'index' => $i,
                            'type' => $request->{'comp_type_' . $i},
                            'title' => $events_component->title,
                            'size' => [
                                'width' => $request->{'width' . $i},
                                'height' => $request->{'height' . $i},
                                'fullwidth' => $request->{'fullwidth' . $ec_id}
                            ],
                            'position' => [
                                'fixed' => $request->{'fixed' . $i},
                                'x' => $request->{'origin_x' . $i},
                                'y' => $request->{'origin_y' . $i},
                                'alignX' => $request->{'alignX' . $ec_id},
                                'alignY' => $request->{'alignY' . $ec_id},
                            ],
                            'selectable'=> $request->{'selectable' . $ec_id},
                            'required'=> $request->{'required' . $ec_id},
                            'settings' => [
                                'input' => [
                                    'length' => [
                                        'min' => $request->{'min' . $i},
                                        'max' => $request->{'max' . $i}
                                    ],
                                    'keyboard_type' => $request->{'keyboard_type' . $ec_id},
                                    'default_text' => $request->{'default_text' . $i},
                                    'first_letter' => $request->{'font_first_letter' . $i},
                                    'font_size' => [
                                        'min' => $request->{'min_size' . $ec_id},
                                        'max' => $request->{'max_size' . $ec_id},
                                    ],
                                    'text_align' => $request->{'text_align' . $ec_id},
                                    'multiline' => $request->{'multiline' . $ec_id},
                                ],
                                'fonts' => $array_fonts,
                                'font_colors' => $array_colors,
                                'smode_colors' => null,
                            ],
                        ];
                        if (isset($array_smode_colors)) {
                            $component_input['settings']['smode_colors'] = $array_smode_colors;
                        }
                        if (isset($events_custom->template['components'])) {
                            $components = $events_custom->template['components'];
                        }
                        else if (!isset($components)) {
                            $components = [];
                        }
                        if (!empty($components)) {
                            foreach ($components as $comp) {
                                if ($comp['id'] == $ec_id) {
                                    $font_to_delete = $comp;
                                    $comp = $component_input;
                                }
                                else {
                                    array_push($components, $component_input);
                                }
                            }
                            if (isset($font_to_delete)) {
                                $result = app('App\Http\Controllers\EventsCustomsController')->removeElement($components, $font_to_delete);
                                $components = $result;
                            }
                        }
                        else {
                            array_push($components, $component_input);
                        }
                    }
                    if ($events_component->type == 'image') {
                        $component_image = [
                            'id' => $request->{'template_component_id' . $i},
                            'type' => $request->{'comp_type_' . $i},
                            'title' => $events_component->title,
                            'index' => $i,
                            'size' => [
                                'width' => $request->{'width' . $i},
                                'height' => $request->{'height' . $i},
                                'fullwidth' => $request->{'fullwidth' . $ec_id}
                            ],
                            'position' => [
                                'fixed' => $request->{'fixed' . $i},
                                'x' => $request->{'origin_x' . $i},
                                'y' => $request->{'origin_y' . $i},
                                'alignX' => $request->{'alignX' . $ec_id},
                                'alignY' => $request->{'alignY' . $ec_id}
                            ],
                            'selectable' => $request->{'selectable' . $ec_id},
                            'settings' => [
                                'image' => [],
                            ]
                        ];
                        if ($request->hasFile('comp_image' . $ec_id)) {
                            $events_custom_event_id = $request->events_custom_event_id;
                            $image_file = $request->file('comp_image' . $ec_id);
                            $option_title = $request->{'option_title' . $i};
                            $image_name = time() . $image_file->getClientOriginalName();
                            $newFilePath = 'events/'.$events_custom_event_id.'/images/resized/'.$image_name;
                            $filePath = 'events/'.$events_custom_event_id.'/images/original/'.$image_name;
                            $img_resized = Image::make(file_get_contents($image_file))->widen(600)->save($image_name);
                            $original_img = Image::make(file_get_contents($image_file))->save($image_name);
                            $disk->put($newFilePath, $img_resized, 'public');
                            $disk->put($filePath, $original_img, 'public');
                            if (file_exists(public_path() . '/' . $image_name)) {
                                unlink(public_path() . '/' . $image_name);
                            }
                            $image_file = $newFilePath;
                            $imgs = [
                                'original_url' => $filePath,
                                'display_url' => $newFilePath
                            ];
                            $component_image['settings']['image'] = $imgs;
                        }
                        else {
                            if (isset($events_custom->template['components'])) {
                                foreach ($events_custom->template['components'] as $comp) {
                                    if ($comp['id'] == $ec_id) {
                                        $component_image['settings']['image'] = $comp['settings']['image'];
                                    }
                                }
                            }
                            else {
                                $alert = array(
                                'status' => 'Merci d\'ajouter une image au composant.',
                                'alert-type' => 'danger'
                            );
                            return redirect()->back()->with($alert);
                            }
                        }
                        if (isset($events_custom->template['components'])) {
                            $components = $events_custom->template['components'];
                        }
                        else if (!isset($components)) {
                            $components = [];
                        }
                        if (!empty($components)) {
                            foreach ($components as $comp) {
                                if ($comp['id'] == $ec_id) {
                                    $to_delete = $comp;
                                    $comp = $component_image;
                                }
                                else {
                                    array_push($components, $component_image);
                                }
                            }
                            if (isset($to_delete)) {
                                $result = app('App\Http\Controllers\EventsCustomsController')->removeElement($components, $to_delete);
                                $components = $result;
                                if (empty($components)) {
                                    array_push($components, $component_image);
                                }
                            }
                        }
                        else {
                            array_push($components, $component_image);
                        }
                    }
                }
            }
            $components = array_slice($components, 0);
            $arr_unique = array();
            $components = array_unique($components, SORT_REGULAR);
            $template = Templates::find($events_custom->template_id);
            $events_custom->template = [
                'id' => $events_custom->template_id,
                'title' => $template->title,
                'size' => [
                    'width' => $template->size['width'],
                    'height' => $template->size['height']
                ],
                'position' => [
                    'X' => $template->origin['x'],
                    'y' => $template->origin['y']
                ],
                'components' => $components
            ];
            $events_custom->description = $request->description;
            $events_custom->is_active = $request->is_active;
            $events_custom->update();
            $event = Event::find($events_custom->event_id);
            $event->status = "draft";
            $event->update();
            return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $events_custom = Events_customs::find($id);
        $disk = Storage::disk('s3'); 
        // here I search the id in event array and I delete it
        $events_product = Events_products::find($events_custom->events_product_id);
        function removeElement($array,$value) {
            if (($key = array_search($value, $array)) !== false) {
                unset($array[$key]);
            }
            return $array;
        }
        if ($events_product) {
            foreach ($events_product->event_customs_ids as $events_custom_id) {
                if ($events_custom_id == $id) {
                    $id_to_delete = $events_custom_id;
                }
            }
        }
        if (isset($id_to_delete)) {
            $result = removeElement($events_product->event_customs_ids, $id_to_delete);
            $arr = $events_product->event_customs_ids;
            $arr = $result;
            $events_product->event_customs_ids = $arr;
            $events_product->update();
        }
        // delete images
        if (isset($events_custom->components)) {
            foreach ($events_custom->components as $component) {
                if (isset($component['settings']['image_url']) && $disk->exists($component['settings']['image_url'])) {
                    $disk->delete($component['settings']['image_url']);
                }
            }
        }
        // Delete events_component of this event
        $events_components = Events_component::where('events_custom_id', '=', $id)->get();
        if ($events_components != null) {
            foreach ($events_components as $events_component) {
                app('App\Http\Controllers\EventsComponentController')->destroy($events_component->id);
            }
        }
        // Delete events_custom & redirect w/ message
        $events_custom->delete();
        $event = Event::find($events_custom->event_id);
        $event->status = "draft";
        $event->update();
        $notification = array(
            'status' => 'La personnalisation a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id)->with($notification);
    }

    public function desactivate($id) {
        $events_custom = Events_customs::find($id);
        $events_custom->is_active = false;
        $events_custom->update();
        return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
    }

    public function delete($id) {
        $events_custom = Events_customs::find($id);
        $events_custom->is_deleted = true;
        $events_custom->update();
        return redirect('admin/EventsProducts/show/'.$events_custom->events_product_id);
    }

    public function activate($id) {
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
        $validatedData = \Validator::make($request->all(),[
            'title' => 'required|unique:fonts|string|max:255',
            'file' => 'required|max:4000'
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors'=>$validatedData->errors()->all()]);
        }
        else {
            $disk = Storage::disk('s3'); 
            $font = new Font;
            $font->title = $request->title;
            $font->weight = $request->font_weight;
            $font->is_active = "true";
            $font->is_deleted = "false";
            if ($request->hasFile('file')) {
                $font_file = $request->file('file');
                $name = $font_file->getClientOriginalName();
                $newFilePath = 'fonts/' . $name;
                $disk->put($newFilePath, file_get_contents($font_file), 'public');
                $font->url = $newFilePath;
            }
            $font->file_name = $name;
            $font->save();
            $response = [
                'status' => 'success',
                'msg' => 'Font created and file send to the server',
                'font_id' => $font->id
            ];
            return response()->json($response);
        }
    }

    /**
     * Delete a file.
     *
     * @param  string $font_url
     * @return \Illuminate\Http\Response
     */
    public function deleteFile($font_name)
    {
        $disk = Storage::disk('s3'); 
        $font_url = 'fonts/'.$font_name; 
        $disk->delete($font_url);
        $response = array(
            'status' => 'success',
            'msg' => 'Font file has been deleted'
        );
        return response()->json($response);
    }

    /**
     * Delete a file.
     *
     * @param  string $font_url
     * @return \Illuminate\Http\Response
     */
    public function updateImage($id)
    {
        $events_custom = Events_customs::find($id);
        if ($request->hasFile('custom_img')){
            $disk = Storage::disk('s3');
            $oldPath = $events_custom->imageUrl;
            $file = $request->file('custom_img');
            $name = time() . $file->getClientOriginalName();
            $newFilePath = 'events/'. $events_custom->event_id . '/'. $events_custom->id . '/'. $name;
            $img = Image::make(file_get_contents($file))->heighten(400)->save($name);
            $disk->put($newFilePath, $img, 'public');
            $events_custom->imageUrl = $newFilePath;
            $events_custom->imageFileName = $name;
            $events_custom->imagePath = 'events/'. $events_custom->event_id . '/'. $events_custom->id . '/';
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            if(!empty($events_custom->imageUrl) && $disk->exists($newFilePath)){
            $disk->delete($oldPath);
            }
        }
    }
}