<?php

namespace App\Http\Controllers;

use DB;
use App\Font;
use App\Events_customs;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class FontsController extends Controller
{
    public function __construct(){
        //$this->middleware(isActivate::class);
        // $this->middleware(isAdmin::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $fonts = Font::all();
        return view('admin/Fonts.index', ['fonts' => $fonts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $fonts = Font::all();
        $font_weights = [
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
        return view('admin/Fonts.add', ['font_weights' => $font_weights, 'fonts' => $fonts]);
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
            'title' => 'required|unique:fonts|string|max:255',
            'file_font' => 'required|file|max:4000'
        ]);

        $font = new Font;
        $font->title = $request->title;
        $font->weight = $request->weight;
        $font->is_active = $request->is_active;
        $font->is_deleted = $request->is_deleted;
        $disk = Storage::disk('s3');
        if($request->hasFile('file_font')) {
            $file = $request->file('file_font');
            $title = $request->title;
            // Create file name
            $name = $file->getClientOriginalName();
            // Define the path to file
            $filePath = '/fonts/' . $title . '/' . $name;
            // Upload the new image
            // $disk->put($filePath, $file, 'public');
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            // Put in database
            $font->url = $filePath;
            $font->file_name = $name;
        }
        $font->save();
        $notification = array(
            'status' => 'La police a été correctement ajoutée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Fonts/index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $font = font::find($id);
        $font_weights = [
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
        return view('admin/Fonts.edit', ['font_weights' => $font_weights, 'font' => $font]);
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
                'title' => 'required|unique:fonts|string|max:255',
            ]);
            $id = $request->id;
            $font = Font::find($id);
            $font->weight = $request->weight;
            $font->is_active = $request->is_active;
            $font->is_deleted = $request->is_deleted;
            if($request->hasFile('font_file')) {
                $disk = Storage::disk('s3');
                $oldPath = $font->url;
                // Create image name
                $font_file = $request->file('font_file');
                $name = $font_file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/fonts/'.$name;
                // Upload the new image
                // $disk->put($newFilePath, $font_file, 'public');
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                // Put in database
                $font->url = $newFilePath;
                $font->file_name = $name;
                unlink(public_path() . '/' . $name);
                if(!empty($font->url) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            $font->save();
        }
        else {
            $validatedData = $request->validate([
                'title' => 'required|unique:fonts|string|max:255',
            ]);
            $id = $request->id;
            $font = Font::find($id);
            $font->title = $request->title;
            $font->weight = $request->weight;
            $font->is_active = $request->is_active;
            $font->is_deleted = $request->is_deleted;
            $font->save();
            if($request->hasFile('font_file')) {
                $disk = Storage::disk('s3');
                $oldPath = $font->url;
                // Create image name
                $font_file = $request->file('font_file');
                $name = $font_file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/fonts/'.$name;
                // Upload the new image
                // $disk->put($newFilePath, $font_file, 'public');
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                // Put in database
                $font->url = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($font->url) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            $font->save();
        }
        
        $notification = array(
        'status' => 'La police a été correctement modifiée.',
        'alert-type' => 'success'
        );
        
        return redirect('admin/Fonts/edit/' . $font->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $font = Font::find($id);
        $events_customs = Events_customs::all();
        foreach($events_customs as $events_custom){
            if(isset($events_custom['components'][0]['settings']['fonts'])){
                foreach($events_custom['components'][0]['settings']['fonts'] as $custom_font){
                    if(isset($custom_font['font_id']) && $custom_font['font_id'] == $font->id){
                        $notification = array(
                            'status' => 'Vous ne pouvez pas supprimer cette police car elle est utilisée par un événement.',
                            'alert-type' => 'danger'
                        );
                        return redirect('admin/Fonts/index')->with($notification);
                    }
                    else{
                        // Delete logo image
                        $disk = Storage::disk('s3');
                        $filePath = $font->url;
                        if(!empty($font->url) && $disk->exists($filePath)){
                            $disk->delete($filePath);
                        }
                        // Delete file
                        $font->delete();

                        $notification = array(
                            'status' => 'La police a été correctement supprimée.',
                            'alert-type' => 'success'
                        );
                        return redirect('admin/Fonts/index')->with($notification);
                    }
                }
            }
            else{
                // Delete logo image
                $disk = Storage::disk('s3');
                $filePath = $font->url;
                if(!empty($font->url) && $disk->exists($filePath)){
                    $disk->delete($filePath);
                }
                // Delete file
                $font->delete();

                $notification = array(
                    'status' => 'La police a été correctement supprimée.',
                    'alert-type' => 'success'
                );
                return redirect('admin/Fonts/index')->with($notification);
            }
        }
    }

    public function desactivate($id)
    {
        $font = Font::find($id);
        $font->is_active = false;
        $font->update();
        $notification = array(
            'status' => 'La police a été correctement désactivée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Fonts/index')->with($notification);
    }

    public function delete($id)
    {
        $font = Font::find($id);
        $font->is_deleted = true;
        $font->update();
        $notification = array(
            'status' => 'La police a été correctement supprimée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Fonts/index')->with($notification);
    }

    public function activate($id)
    {
        $font = Font::find($id);
        $font->is_active = true;
        $font->update();
        $notification = array(
            'status' => 'La police a été correctement activée.',
            'alert-type' => 'success'
        );
        return redirect('admin/Fonts/index')->with($notification);
    }
}
