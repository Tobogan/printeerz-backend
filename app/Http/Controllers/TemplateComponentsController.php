<?php

namespace App\Http\Controllers;

use DB;
use App\Template_components;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
        return view('admin/TemplatesComponents.index', ['template_components' => $template_components]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template_components = Template_components::all();
        return view('admin/TemplatesComponents.add', ['template_components' => $template_components]);
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
            'type' => 'required|string|max:255'
        ]);
        $template_component = new Template_components;
        $template_component->title = $request->title;
        $template_component->comp_type = $request->type;
        //  si requête type image j'injecte l'image
        $disk = Storage::disk('s3');
        if ($request->hasFile('image')){
            // Get file
            $file = $request->file('image');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/templatesComponents/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
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
                    // $url = time().$i.'.'.$request_font_url->getClientOriginalExtension();
                    // $request_font_url->move(public_path('uploads'), $url);
                    $font = array(
                        'id' =>  $request_font_id,
                        'name' => $request_font_name,
                        // 'url' => $url,
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
        // $font_transform = [
        //     'none'=>'Aucune',
        //     'uppercase'=>'Tout en Majuscules',
        //     'capitalize'=>'Première lettre en Majuscule',
        //     'lowercase'=>'Tout en minuscule',
        //     'full-width'=>'Pleine largeur'
        // ];
        // $font_weight = [
        //     '100'=>'Thin (100)',
        //     '200'=>'Extra Light (200)',
        //     '300'=>'Light (300)',
        //     '400'=>'Normal (400)',
        //     '500'=>'Medium (500)',
        //     '600'=>'Semi Bold (600)',
        //     '700'=>'Bold (700)',
        //     '800'=>'Extra Bold (800)',
        //     '900'=>'Black (900)'
        // ];
        return view('admin/TemplatesComponents.edit', ['template_component' => $template_component, 'disk' => $disk, 's3' => $s3, 'exists' => $exists]);
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
                'title' => 'required|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            $template_component->comp_type = $request->type;
            //  si requête type image j'injecte l'image
            if ($request->hasFile('image')){
                // Get current image path
                $oldPath = $template_component->image;
                // Get new image
                $file = $request->file('image');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templatesComponents/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
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
                // $template_component->font = array(
                //     'id' =>  $request->font_id,
                //     'name' => $request->font_name,
                //     // 'url' => $request->font_url,
                //     'weight' => $request->font_weight,
                //     'transform' => $request->font_transform,
                //     'first_letter' => $request->font_first_letter,
                // );
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
                'type' => 'required|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            $template_component->title = $request->title;
            $template_component->comp_type = $request->type;
            //  si requête type image j'injecte l'image
            if ($request->hasFile('image')){
                // Get current image path
                $oldPath = $template_component->image;
                // Get new image
                $file = $request->file('image');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templatesComponents/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(800)->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
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
                // $template_component->font = array(
                //     'id' =>  $request->font_id,
                //     'name' => $request->font_name,
                //     // 'url' => $request->font_url,
                //     'weight' => $request->font_weight,
                //     'transform' => $request->font_transform,
                //     'first_letter' => $request->font_first_letter,
                // );
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
