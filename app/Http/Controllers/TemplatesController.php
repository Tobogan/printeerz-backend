<?php

namespace App\Http\Controllers;

use DB;
use App\Templates;
use App\Template_components;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TemplatesController extends Controller
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
        $templates = Templates::all();
        $templates_components = Template_components::all();

        return view('admin/Templates.index', ['templates' => $templates, 'templates_components' => $templates_components]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Templates::all();
        return view('admin/Templates.add', ['templates' => $templates]);
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
            'category' => 'required|string|max:255'
        ]);
        $template = new Templates;
        $template->title = $request->title;
        $template->category = $request->category;
        
        if ($request->hasFile('thumb')){
            $thumb = time().'.'.request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('uploads'), $thumb);
        }
        if ($request->hasFile('full')){
            $full = time().'1.'.request()->full->getClientOriginalExtension();
            request()->full->move(public_path('uploads'), $full);
        }
        if (!empty($full) && !empty($thumb)){
            $template->image = array(
                'thumb' => $thumb,
                'full' => $full
            );
        }
        $template->size = array(
            'width' => $request->width,
            'height' => $request->height
        );
        $template->origin = array(
            'x' => $request->origin_x,
            'y' => $request->origin_y
        );
        $template->components_ids = $request->get('components_ids');
        $template->position = $request->position;
        $template->is_active = $request->is_active; 
        $template->is_deleted = $request->is_deleted;

        $template->save();
        return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement ajouté.');
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
        $template = Templates::find($id);
        return view('admin/Templates.edit', ['template' => $template]);
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
                'category' => 'required|string|max:255'
            ]);
            $template = new Templates;
            $template->title = $request->title;
            $template->category = $request->category;
            
            if ($request->hasFile('thumb')){
                $thumb = time().'.'.request()->thumb->getClientOriginalExtension();
                request()->thumb->move(public_path('uploads'), $thumb);
            }
            if ($request->hasFile('full')){
                $full = time().'1.'.request()->full->getClientOriginalExtension();
                request()->full->move(public_path('uploads'), $full);
            }
            if (isset($thumb) && isset($full)) {
                $template->image = array(
                    'thumb' => $thumb,
                    'full' => $full
                );
            }
            else if (isset($thumb) && !isset($full)) {
                $template->image = array(
                    'thumb' => $thumb
                );
            }
            else if (!isset($thumb) && isset($full)) {
                $template->image = array(
                    'full' => $full
                );
            }
            $template->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            $template->components_ids = $request->get('components_ids');
            $template->position = $request->position;
            $template->is_active = $request->is_active; 
            $template->is_deleted = $request->is_deleted;
            $template->save();
            return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement modifié.');
        }
        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:255'
            ]);
            $template = new Templates;
            $template->title = $request->title;
            $template->category = $request->category;
            
            if ($request->hasFile('thumb')){
                $thumb = time().'.'.request()->thumb->getClientOriginalExtension();
                request()->thumb->move(public_path('uploads'), $thumb);
            }
            if ($request->hasFile('full')){
                $full = time().'1.'.request()->full->getClientOriginalExtension();
                request()->full->move(public_path('uploads'), $full);
            }
            if (isset($thumb) && isset($full)) {
                $template->image = array(
                    'thumb' => $thumb,
                    'full' => $full
                );
            }
            else if (isset($thumb) && !isset($full)) {
                $template->image = array(
                    'thumb' => $thumb
                );
            }
            else if (!isset($thumb) && isset($full)) {
                $template->image = array(
                    'full' => $full
                );
            }
            
            $template->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            $template->components_ids = $request->get('components_ids');
            $template->position = $request->position;
            $template->is_active = $request->is_active; 
            $template->is_deleted = $request->is_deleted;
            $template->save();
            return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement modifié.');
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
        $template = Templates::find($id);
        $file_path_thumb = public_path('uploads/').$template->image["thumb"];
        if(file_exists(public_path('uploads/'.$template->image["thumb"])) && !empty($template->image["thumb"])){
            unlink($file_path_thumb);
        }
        $file_path_full = public_path('uploads/').$template->image["full"];
        if(file_exists(public_path('uploads/'.$template->image["full"])) && !empty($template->image["full"])){
            unlink($file_path_full);
        }
        $template->delete();
        return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement supprimé.');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a template function in index template__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $template = Templates::find($id);
        $template->is_active = false;
        $template->update();
        return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement désactivé.');
    }

    public function delete($id)
    {
        $template = Templates::find($id);
        $template->is_deleted = true;
        $template->update();
        return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement effacé.');
    }

    public function activate($id)
    {
        $template = Templates::find($id);
        $template->is_active = true;
        $template->update();
        return redirect('admin/Templates/index')->with('status', 'Le gabarit a été correctement activé.');
    }
}
