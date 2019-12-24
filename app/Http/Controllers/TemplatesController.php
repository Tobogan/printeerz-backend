<?php

namespace App\Http\Controllers;

use DB;
use App\Templates;
use App\Template_components;
use App\Events_customs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Illuminate\Support\Facades\Auth;

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
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $exists = $disk->exists('file.jpg');
        $templates_components = Template_components::all();

        return view('admin/Templates.index', [
            'templates' => $templates, 
            'templates_components' => $templates_components, 
            'disk' => $disk, 
            's3' => $s3, 
            'exists' => $exists
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
        $templates = Templates::all();
        return view('admin/Templates.add', [
            'templates' => $templates
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
            'title' => 'required|string|unique:templates|max:255',
            'width' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            'origin_x' => 'required|string|max:255',
            'origin_y' => 'required|string|max:255',
            'thumb' => 'image|mimes:jpeg,jpg,png|max:4000',
            'full' => 'image|mimes:jpeg,jpg,png|max:4000',
            'category' => 'nullable|string|max:255',
            'templateComponentsList' => 'required|string|min:6|max:255'
        ]);
        $template = new Templates;
        $template->created_by = Auth::user()->username;
        $template->title = $request->title;
        $template->category = $request->category;
        $disk = Storage::disk('s3');
        $template->size = array(
            'width' => $request->width,
            'height' => $request->height
        );
        $template->origin = array(
            'x' => $request->origin_x,
            'y' => $request->origin_y
        );
        $i=0;
        if(json_decode($request->get('templateComponentsList')) !== false){
            foreach(json_decode($request->get('templateComponentsList')) as $templates_component){
                $i++;
                $templates_component->name == $templates_component->name.'(gabarit n°'.$i.')';
            }
            $template->components_ids = json_decode($request->get('templateComponentsList'));
        }
        $template->position = $request->position;
        $template->is_active = $request->is_active; 
        $template->is_deleted = $request->is_deleted;
        $template->save();
        if ($request->hasFile('thumb')){
            $file = $request->file('thumb');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/templates/'.$template->id.'/'.$name;
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            $disk->put($filePath, $img, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            $template->thumb_img = $filePath;
        }
        if ($request->hasFile('full')){
            $file = $request->file('full');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/templates/'.$template->id.'/'.$name;
            $img = Image::make(file_get_contents($file))->save($name);
            $disk->put($filePath, $img, 'public');
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            $template->full_img = $filePath;
        }
        $template->save();
        $notification = array(
            'status' => 'Le gabarit a été correctement créé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
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
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        return view('admin/Templates.edit', [
            's3' => $s3, 
            'disk' => $disk, 
            'template' => $template
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
                'width' => 'required|string|max:255',
                'height' => 'required|string|max:255',
                'origin_x' => 'required|string|max:255',
                'origin_y' => 'required|string|max:255',
                'thumb' => 'image|mimes:jpeg,jpg,png|max:4000',
                'full' => 'image|mimes:jpeg,jpg,png|max:4000',
                'category' => 'nullable|string|max:255'
            ]);
            $id = $request->template_id;
            $template = Templates::find($id);
            $template->title = $request->title;
            $template->category = $request->category;
            $disk = Storage::disk('s3');
            if ($request->hasFile('thumb')){
                $oldPath = $template->thumb_img;
                $file = $request->file('thumb');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templates/'.$template->id.'/'.$name;
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                $template->thumb_img = $newFilePath;
                if(!empty($template->thumb_img) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            if ($request->hasFile('full')){
                $file = $request->file('full');
                $oldPath = $template->thumb_full;
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templates/'.$template->id.'/'.$name;
                $img = Image::make(file_get_contents($file))->save($name);
                $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                $template->full_img = $newFilePath;
                if(!empty($template->full_img) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            $template->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            if ($request->get('templateComponentsList')[0] !== 'false') {
                $templates_components_ids = implode(',', $request->get('templateComponentsList'));
                $template->components_ids = json_decode($templates_components_ids);
            }
            else {
                $template->components_ids = $template->components_ids;
            }
            $template->position = $request->position;
            $template->is_active = $request->is_active; 
            $template->is_deleted = $request->is_deleted;
        }
        else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'width' => 'required|string|max:255',
                'height' => 'required|string|max:255',
                'origin_x' => 'required|string|max:255',
                'origin_y' => 'required|string|max:255',
                'thumb' => 'image|mimes:jpeg,jpg,png|max:4000',
                'full' => 'image|mimes:jpeg,jpg,png|max:4000',
                'category' => 'nullable|string|max:255'

            ]);
            $id = $request->template_id;
            $template = Templates::find($id);
            $template->title = $request->title;
            $template->category = $request->category;
            
            if ($request->hasFile('thumb')){
                $oldPath = $template->thumb_img;
                $file = $request->file('thumb');
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templates/'.$template->id.'/'.$name;
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                $template->thumb_img = $newFilePath;
                if (!empty($template->thumb_img) && $disk->exists($newFilePath)) {
                    $disk->delete($oldPath);
                }
            }
            if ($request->hasFile('full')) {
                $file = $request->file('full');
                $oldPath = $template->thumb_full;
                $name = time() . $file->getClientOriginalName();
                $newFilePath = '/templates/'.$template->id.'/'.$name;
                $img = Image::make(file_get_contents($file))->save($name);
                $disk->put($newFilePath, $img, 'public');
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                $template->full_img = $newFilePath;
                if (!empty($template->full_img) && $disk->exists($newFilePath)) {
                    $disk->delete($oldPath);
                }
            }
            $template->size = array(
                'width' => $request->width,
                'height' => $request->height
            );
            $template->origin = array(
                'x' => $request->origin_x,
                'y' => $request->origin_y
            );
            if ($request->get('templateComponentsList')[0] !== 'false') {
                $templates_components_ids = implode(',', $request->get('templateComponentsList'));
                $template->components_ids = json_decode($templates_components_ids);
            }
            else {
                $template->components_ids = $template->components_ids;
            }
            $templates_components_ids = implode(',', $request->get('templateComponentsList'));
            $template->components_ids = json_decode($templates_components_ids);
            $template->position = $request->position;
            $template->is_active = $request->is_active; 
            $template->is_deleted = $request->is_deleted;
        }
        $template->update();
        $notification = array(
            'status' => 'Le gabarit a été correctement modifié.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
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
        $events_customs = Events_customs::all();
        foreach($events_customs as $events_custom){
            if($events_custom->template_id == $id){
                $notification = array(
                    'status' => 'Vous ne pouvez pas supprimer ce gabarit car il est utilisé dans un événement.',
                    'alert-type' => 'danger'
                );
                return redirect('admin/Templates/index')->with($notification);
            }
            else{
            // Delete Thumb image
            $disk = Storage::disk('s3');
            $fileThumbPath = $template->thumb_img;
            if(!empty($template->thumb_img) && $disk->exists($fileThumbPath)){
                $disk->delete($fileThumbPath);
            }
            $fileFullPath = $template->full_img;
            if(!empty($template->full_img) && $disk->exists($fileFullPath)){
                $disk->delete($fileFullPath);
            }
            $template->delete();
            $notification = array(
                'status' => 'Le gabarit a été correctement supprimé.',
                'alert-type' => 'success'
            );
            return redirect('admin/Templates/index')->with($notification);
            }
        }
    }

    public function desactivate($id)
    {
        $template = Templates::find($id);
        $template->is_active = false;
        $template->update();
        $notification = array(
            'status' => 'Le gabarit a été désactivé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
    }

    public function delete($id)
    {
        $template = Templates::find($id);
        $template->is_deleted = true;
        $template->update();
        $notification = array(
            'status' => 'Le gabarit a été correctement effacé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
    }

    public function activate($id)
    {
        $template = Templates::find($id);
        $template->is_active = true;
        $template->update();
        $notification = array(
            'status' => 'Le gabarit est maintenant activé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
    }
}
