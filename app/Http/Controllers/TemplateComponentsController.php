<?php

namespace App\Http\Controllers;

use DB;
use App\Template_components;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

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
        $template_component->type = $request->type;
        //  si requête type image j'injecte l'image
        if($request->type == 'image') {
            if ($request->hasFile('image')){
                $image = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('uploads'), $image);
    
                $template_component->image = $image;
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
        if($request->type == 'input') {
            $template_component->characters = array(
                'min' => $request->min,
                'max' => $request->max
            );
            $template_component->highlight = array(
                'available' => $request->available,
                'always' => $request->always
            );
            $template_component->font = array(
                'id' =>  $request->font_id,
                'name' => $request->font_name,
                'url' => $request->font_url,
                'weight' => $request->font_weight,
                'transform' => $request->font_transform,
                'first_letter' => $request->font_first_letter,
            );
        }
        $template_component->is_customizable = $request->is_customizable;
        $template_component->is_active = $request->is_active; 
        $template_component->is_deleted = $request->is_deleted;
        $template_component->save();
        return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement crée.');
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
        return view('admin/TemplatesComponents.edit', ['template_component' => $template_component]);
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
                'type' => 'required|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            $template_component->type = $request->type;
            //  si requête type image j'injecte l'image
            if($request->type == 'image') {
                if ($request->hasFile('image')){
                    $image = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('uploads'), $image);
        
                    $template_component->image = $image;
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
                $template_component->font = array(
                    'id' =>  $request->font_id,
                    'name' => $request->font_name,
                    'url' => $request->font_url,
                    'weight' => $request->font_weight,
                    'transform' => $request->font_transform,
                    'first_letter' => $request->font_first_letter,
                );
            }
            $template_component->is_customizable = $request->is_customizable;
            $template_component->is_active = $request->is_active; 
            $template_component->is_deleted = $request->is_deleted;
            $template_component->save();
            return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement modifié.');
        }
        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|string|max:255'
            ]);
            $id = $request->template_component_id;
            $template_component = Template_components::find($id);
            $template_component->title = $request->title;
            $template_component->type = $request->type;
            //  si requête type image j'injecte l'image
            if($request->type == 'image') {
                if ($request->hasFile('image')){
                    $image = time().'.'.request()->image->getClientOriginalExtension();
                    request()->image->move(public_path('uploads'), $image);
        
                    $template_component->image = $image;
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
                $template_component->font = array(
                    'id' =>  $request->font_id,
                    'name' => $request->font_name,
                    'url' => $request->font_url,
                    'weight' => $request->font_weight,
                    'transform' => $request->font_transform,
                    'first_letter' => $request->font_first_letter,
                );
            }
            $template_component->is_customizable = $request->is_customizable;
            $template_component->is_active = $request->is_active; 
            $template_component->is_deleted = $request->is_deleted;
            $template_component->save();
            return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement modifié.');
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
        $template = Template_components::find($id);
            $file_path_thumb = public_path('uploads/').$template->image;
            if(file_exists(public_path('uploads/'.$template->image)) && !empty($template->image)){
                unlink($file_path_thumb);
            }
        $template->delete();
        return redirect('admin/TemplatesComponents/index')->with('status', 'Le client a été correctement supprimé.');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a template function in index template__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $template = Template_components::find($id);
        $template->is_active = false;
        $template->update();
        return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement désactivé.');
    }

    public function delete($id)
    {
        $template = Template_components::find($id);
        $template->is_deleted = true;
        $template->update();
        return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement effacé.');
    }

    public function activate($id)
    {
        $template = Template_components::find($id);
        $template->is_active = true;
        $template->update();
        return redirect('admin/TemplatesComponents/index')->with('status', 'Le composant a été correctement activé.');
    }
}

    // $fonts = array();
    // for($i=1; $i<5; $i++){
    //     if ($request->hasFile('font_url_'.$i)){
    //         $request_font_url =  $request->{'font_url_'.$i};
    //         $request_font_id =  $request->{'font_id_'.$i};
    //         $request_font_name =  $request->{'font_name_'.$i};
    //         $request_font_weight =  $request->{'font_weight_'.$i};
    //         $request_font_transform =  $request->{'font_transform_'.$i};
    //         $request_font_first_letter =  $request->{'font_first_letter_'.$i};
    //         $url = time().$i.'.'.$request_font_url->getClientOriginalExtension();
    //         $request_font_url->move(public_path('uploads'), $url);
    //         $font = array(
    //             'id' =>  $request_font_id,
    //             'name' => $request_font_name,
    //             'url' => $url,
    //             'weight' => $request_font_weight,
    //             'transform' => $request_font_transform,
    //             'first_letter' => $request_font_first_letter,
    //         );
    //         array_push($fonts , $font);
    //     }
    // }
    // $template_component->fonts = $fonts;
