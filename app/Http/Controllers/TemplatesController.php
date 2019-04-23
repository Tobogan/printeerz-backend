<?php

namespace App\Http\Controllers;

use DB;
use App\Templates;
use App\Template_components;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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

        return view('admin/Templates.index', ['templates' => $templates, 'templates_components' => $templates_components, 'disk' => $disk, 's3' => $s3, 'exists' => $exists]);
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
        
        $disk = Storage::disk('s3');
        if ($request->hasFile('thumb')){
            // Get file
            $file = $request->file('thumb');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/templates/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $thumb = $filePath;
        }
        if ($request->hasFile('full')){
            // Get file
            $file = $request->file('full');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/templates/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $full = $filePath;
        }
        $template->size = array(
            'width' => $request->width,
            'height' => $request->height
        );
        $template->origin = array(
            'x' => $request->origin_x,
            'y' => $request->origin_y
        );
        $i=0;
        foreach(json_decode($request->get('templateComponentsList')) as $templates_component){
            $i++;
            $templates_component->name == $templates_component->name.'(gabarit n°'.$i.')';
        }
        $template->components_ids = json_decode($request->get('templateComponentsList'));
        $template->position = $request->position;
        $template->is_active = $request->is_active; 
        $template->is_deleted = $request->is_deleted;

        $template->save();
        $notification = array(
            'status' => 'Le gabarit a été correctement créé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
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
            $id = $request->template_id;
            $template = Templates::find($id);
            $template->title = $request->title;
            $template->category = $request->category;
            $disk = Storage::disk('s3');
            if ($request->hasFile('thumb')){
                // Get current image path
                $oldPath = $template->image["thumb"];
                // Get new image
                $file = $request->file('thumb');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templates/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
                // Put in database
                $user->profile_img = $newFilePath;
                if(!empty($template->image["thumb"]) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            if ($request->hasFile('full')){
                // Get current image path
                $oldPath = $template->image["full"];
                // Get new image
                $file = $request->file('full');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templates/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
                // Put in database
                $user->profile_img = $newFilePath;
                if(!empty($template->image["full"]) && $disk->exists($newFilePath)){
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
            $templates_components_ids = implode(',', $request->get('templateComponentsList'));
            $template->components_ids = json_decode($templates_components_ids);
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
            $id = $request->template_id;
            $template = Templates::find($id);
            $template->title = $request->title;
            $template->category = $request->category;
            
            if ($request->hasFile('thumb')){
                // Get current image path
                $oldPath = $template->image["thumb"];
                // Get new image
                $file = $request->file('thumb');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templates/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
                // Put in database
                $user->profile_img = $newFilePath;
                if(!empty($template->image["thumb"]) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            if ($request->hasFile('full')){
                // Get current image path
                $oldPath = $template->image["full"];
                // Get new image
                $file = $request->file('full');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/templates/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
                // Put in database
                $user->profile_img = $newFilePath;
                if(!empty($template->image["full"]) && $disk->exists($newFilePath)){
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
            $templates_components_ids = implode(',', $request->get('templateComponentsList'));
            $template->components_ids = json_decode($templates_components_ids);
            $template->position = $request->position;
            $template->is_active = $request->is_active; 
            $template->is_deleted = $request->is_deleted;
            $template->save();
            $notification = array(
                'status' => 'Le gabarit a été correctement modifié.',
                'alert-type' => 'success'
            );
            return redirect('admin/Templates/index')->with($notification);
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
        // Delete Thumb image
        $disk = Storage::disk('s3');
        $fileThumbPath = $template->image["thumb"];
        if(!empty($template->image["thumb"]) && $disk->exists($fileThumbPath)){
            $disk->delete($fileThumbPath);
        }
        $fileFullPath = $template->image["full"];
        if(!empty($template->image["full"]) && $disk->exists($fileFullPath)){
            $disk->delete($fileFullPath);
        }
        $template->delete();
        $notification = array(
            'status' => 'Le gabarit a été correctement supprimé.',
            'alert-type' => 'success'
        );
        return redirect('admin/Templates/index')->with($notification);
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
