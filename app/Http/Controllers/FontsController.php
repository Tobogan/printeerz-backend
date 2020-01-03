<?php

namespace App\Http\Controllers;

use DB;
use App\Font;
use App\Events_customs;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

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
        return view('admin/Fonts.index', [
            'fonts' => $fonts
            ]
        );
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
        return view('admin/Fonts.add', [
            'font_weights' => $font_weights, 
            'fonts' => $fonts
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
            'title' => 'required|unique:fonts|string|max:255',
            'file_font' => 'required|max:4000'
        ]);

        $font = new Font;
        $font->created_by = Auth::user()->username;
        $font->title = $request->title;
        $font->weight = $request->weight;
        $font->is_active = $request->is_active;
        $font->is_deleted = $request->is_deleted;
        $disk = Storage::disk('s3');
        if($request->hasFile('file_font')) {
            $file = $request->file('file_font');
            $title = $request->title;
            $name = $file->getClientOriginalName();
            $filePath = 'fonts/' . $name;
            if (file_exists(public_path() . '/' . $name)) {
                unlink(public_path() . '/' . $name);
            }
            $disk->put($filePath, file_get_contents($file), 'public');
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
        return view('admin/Fonts.edit', [
            'font_weights' => $font_weights, 
            'font' => $font
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
        if (request('actual_title') == request('title') || request('actual_title') !== request('title')){
            if (request('actual_title') == request('title')) {
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'file_font' => 'required|max:4000'
                ]);
            }
            else {
                $validatedData = $request->validate([
                    'title' => 'required|unique:fonts|string|max:255',
                    'file_font' => 'required|max:4000'
                ]);
            }
            $id = $request->font_id;
            $font = Font::find($id);
            if (request('actual_title') !== request('title')) {
                $font->title = $request->title;
            }
            $font->created_by = Auth::user()->username;
            $font->weight = $request->weight;
            $font->is_active = $request->is_active;
            $font->is_deleted = $request->is_deleted;
            if ($request->hasFile('font_file')) {
                $disk = Storage::disk('s3');
                $oldPath = $font->url;
                $font_file = $request->file('font_file');
                $name = $font_file->getClientOriginalName();
                $newFilePath = 'fonts/' . $name;
                $disk->put($newFilePath, file_get_contents($file), 'public');
                $font->url = $newFilePath;
                $font->file_name = $name;
                if (file_exists(public_path() . '/' . $name)) {
                    unlink(public_path() . '/' . $name);
                }
                if(!empty($font->url) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
            $font->update();
        }
        $notification = array(
        'status' => 'La police a été correctement modifiée.',
        'alert-type' => 'success'
        );
         return redirect('admin/Fonts/index')->with($notification);
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
        $events_customs_with_font = Events_customs::where('font_id', '=', $id);
        foreach($events_customs_with_font as $el) {
            if ($events_customs_with_font !== null) {
                $notification = array(
                    'status' => 'Vous ne pouvez pas supprimer cette police car elle est utilisée par un événement.',
                    'alert-type' => 'danger'
                );
                return redirect('admin/Fonts/index')->with($notification);
            }
        }
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
