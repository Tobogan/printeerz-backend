<?php

namespace App\Http\Controllers;

use DB;
use App\Template_components;
use App\Templates;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

class TemplateComponentsController extends Controller
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
        $template_components = Template_components::all();
        return view('admin/TemplatesComponents.index', [
            'template_components' => $template_components
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template_components = Template_components::all();
        return view('admin/TemplatesComponents.add', [
            'template_components' => $template_components
            ]
        );
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
            'title' => 'required|string|unique:template_components|max:255',
            'height' => 'nullable|string|max:255',
            'width' => 'nullable|string|max:255',
            'origin_x' => 'nullable|string|max:255',
            'origin_y' => 'nullable|string|max:255',
            'min' => 'nullable|string|max:255',
            'max' => 'nullable|string|max:255',
            'image' => 'image|mimes:jpeg,jpg,png|max:4000',
            'type' => 'required|string|max:255'
        ]);
        $template_component = new Template_components;
        $template_component->created_by = Auth::user()->username;
        $template_component->title = $request->title;
        $template_component->comp_type = $request->type;
        //  si requête type image j'injecte l'image
        $disk = Storage::disk('s3');
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/templatesComponents/' . $name;
            $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
            $disk->put($filePath, $img, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            // Put in database
            $template_component->image = $filePath;
        }
        //  data communes aux deux types de component maggle
        $template_component->size = array(
            'width' => $request->width,
            'height' => $request->height
        );
        $template_component->origin = array(
            'x' => $request->origin_x,
            'y' => $request->origin_y
        );
        //  si il y a une requête type input je boucle pour chaque police
        if($request->type == 'input') {
            $template_component->characters = array(
                'min' => $request->min,
                'max' => $request->max
            );
            $template_component->highlight = array(
                'available' => $request->available,
                'always' => $request->always
            );
            $fonts = array();
            for($i=1; $i<5; $i++){
                if ($request->hasFile('font_url_'.$i)){
                    $request_font_url =  $request->{'font_url_'.$i};
                    $request_font_id =  $request->{'font_id_'.$i};
                    $request_font_name =  $request->{'font_name_'.$i};
                    $request_font_weight =  $request->{'font_weight_'.$i};
                    $request_font_transform =  $request->{'font_transform_'.$i};
                    $request_font_first_letter =  $request->{'font_first_letter_'.$i};
                    $font = array(
                        'id' =>  $request_font_id,
                        'name' => $request_font_name,
                        'weight' => $request_font_weight,
                        'transform' => $request_font_transform,
                        'first_letter' => $request_font_first_letter,
                    );
                    array_push($fonts , $font);
                }
            }
            $template_component->fonts = $fonts;
        }
        $template_component->is_customizable = $request->is_customizable;
        $template_component->is_active = $request->is_active; 
        $template_component->is_deleted = $request->is_deleted;
        $template_component->save();

        $notification = array(
            'status' => 'Le composant a été correctement crée',
            'alert-type' => 'success'
        );

        return redirect('admin/TemplatesComponents/index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = array(
            'status' => 'Le gabarit a été correctement supprimé.',
            'alert-type' => 'success'
        );
        return redirect('admin/TemplatesComponents/index')->with($notification);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template_component = Template_components::find($id);
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $exists = $disk->exists('file.jpg');
        return view('admin/TemplatesComponents.edit', [
            'template_component' => $template_component, 
            'disk' => $disk, 
            's3' => $s3, 
            'exists' => $exists
            ]
        );
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
                'title' => 'required|string|max:255',
                'height' => 'nullable|string|max:255',
                'width' => 'nullable|string|max:255',
                'origin_x' => 'nullable|string|max:255',
                'origin_y' => 'nullable|string|max:255',
                'min' => 'nullable|string|max:255',
                'max' => 'nullable|string|max:255',
                'image' => 'image|mimes:jpeg,jpg,png|max:4000',
                'type' => 'nullable|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            //  si requête type image j'injecte l'image
            if ($request->hasFile('image')) {
                $oldPath = $template_component->image;
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templatesComponents/' . $name;
                $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                // Put in database
                $template_component->image = $newFilePath;
                if(!empty($template_component->image) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            //  data communes aux deux types de component maggle
            $template_component->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template_component->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            //  si il y a une requête type input je boucle pour chaque police
            if ($request->type == 'input') {
                $template_component->characters = array(
                    'min' => $request->min,
                    'max' => $request->max
                );
                $template_component->highlight = array(
                    'available' => $request->available,
                    'always' => $request->always
                );
            }
            $template_component->is_customizable = $request->is_customizable;
            $template_component->is_active = $request->is_active; 
            $template_component->is_deleted = $request->is_deleted;
            $template_component->save();
            $notification = array(
                'status' => 'Le gabarit a été correctement modifié.',
                'alert-type' => 'success'
            );
            return redirect('admin/TemplatesComponents/index')->with($notification);
        }
        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'height' => 'nullable|string|max:255',
                'width' => 'nullable|string|max:255',
                'origin_x' => 'nullable|string|max:255',
                'origin_y' => 'nullable|string|max:255',
                'min' => 'nullable|string|max:255',
                'max' => 'nullable|string|max:255',
                'image' => 'image|mimes:jpeg,jpg,png|max:4000',
                'type' => 'nullable|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            $template_component->title = $request->title;
            //  si requête type image j'injecte l'image
            if ($request->hasFile('image')){
                $oldPath = $template_component->image;
                $file = $request->file('image');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templatesComponents/' . $name;
                $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                $template_component->image = $newFilePath;
                if(!empty($template_component->image) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            //  data communes aux deux types de component maggle
            $template_component->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template_component->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            //  s'il y a une requête type input je boucle pour chaque police
            if($request->type == 'input') {
                $template_component->characters = array(
                    'min' => $request->min,
                    'max' => $request->max
                );
                $template_component->highlight = array(
                    'available' => $request->available,
                    'always' => $request->always
                );
            }
            $template_component->is_customizable = $request->is_customizable;
            $template_component->is_active = $request->is_active; 
            $template_component->is_deleted = $request->is_deleted;
            $template_component->save();
            $notification = array(
                'status' => 'Le gabarit a été correctement modifié.',
                'alert-type' => 'success'
            );
            return redirect('admin/TemplatesComponents/index')->with($notification);
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
        $templates = Templates::all();
        foreach($templates as $template){
            foreach($template['components_ids'] as $value){
                // dd($id);
                if($id == $value['id']){
                    $notification = array(
                        'status' => 'Vous ne pouvez pas supprimer ce composant car il est utilisé pour le gabarit : '.$template->title,
                        'alert-type' => 'danger'
                    );
                    return redirect('admin/TemplatesComponents/index')->with($notification);
                }
                else{
                    $template_component = Template_components::find($id);
                    $disk = Storage::disk('s3');
                    $filePath = $template_component->image;
                    if(!empty($template_component->image) && $disk->exists($filePath)){
                        $disk->delete($filePath);
                    }
                    $template_component->delete();
                    $notification = array(
                        'status' => 'Le composant a été correctement supprimé.',
                        'alert-type' => 'success'
                    );
                    return redirect('admin/TemplatesComponents/index')->with($notification);
                }
            }
        }
    }

    // activate and desactivate a template function in index template
    public function desactivate($id)
    {
        $template_component = Template_components::find($id);
        $template_component->is_active = false;
        $template_component->update();
        $notification = array(
            'status' => 'Le composant a été correctement désactivé.',
            'alert-type' => 'success'
        );
        return redirect('admin/TemplatesComponents/index')->with($notification);
    }

    public function delete($id)
    {
        $template = Template_components::find($id);
        $template->is_deleted = true;
        $template->update();
        $notification = array(
            'status' => 'Le composant a été correctement supprimé.',
            'alert-type' => 'success'
        );
        return redirect('admin/TemplatesComponents/index')->with($notification);
    }

    public function activate($id)
    {
        $template = Template_components::find($id);
        $template->is_active = true;
        $template->update();
        $notification = array(
            'status' => 'Le composant a été activé.',
            'alert-type' => 'success'
        );
        return redirect('admin/TemplatesComponents/index')->with($notification);
    }
}
