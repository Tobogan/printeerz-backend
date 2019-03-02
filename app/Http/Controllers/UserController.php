<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

//use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Controller
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
        $users = User::all();
        $disk = Storage::disk('s3');
        $s3 = 'https://s3.eu-west-3.amazonaws.com/printeerz-dev';
        $exists = $disk->exists('file.jpg');
        return view('admin/User.index', ['users' => $users, 'disk' => $disk, 's3' => $s3, 'exists' => $exists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/User.add');
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
            'username' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = new User;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->is_active = $request->is_active;
        $user->is_deleted = $request->is_deleted;
        $disk = Storage::disk('s3');
        if ($request->hasFile('profile_img')){
            // Get file
            $file = $request->file('profile_img');
            // Create name
            $name = time() . $file->getClientOriginalName();
            // Define the path
            $filePath = '/users/' . $name;
            // Resize img
            $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
            // Upload the file
            $disk->put($filePath, $img, 'public');
            // Delete public copy
            unlink(public_path() . '/' . $name);
            // Put in database
            $user->profile_img = $filePath;
        }
        $user->save();
        return redirect('admin/User/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin/User.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        //$user = Auth::user();
        return view('admin/User.edit', ['user' => $user]);
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
        if (request('actual_email') == request('email')){
            if($request->password != null) {
                $validatedData = $request->validate([
                    'username' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'firstname' => 'required|string|max:255',
                    'password' => 'string|min:6|confirmed',
                    'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            }
            else {
                $validatedData = $request->validate([
                    'username' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'firstname' => 'required|string|max:255',
                    'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            }
            
            $user_id = $request->user_id;
            $user = User::find($user_id);

            // Update Profile image
            if ($request->hasFile('profile_img')){
                $disk = Storage::disk('s3');
                // Get current image path
                $oldPath = $user->profile_img;
                // Get new image
                $file = $request->file('profile_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/users/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                // Upload the new image
                $disk->put($newFilePath, $img, 'public');
                // Put in database
                $user->profile_img = $newFilePath;
                unlink(public_path() . '/' . $name);
                if(!empty($user->profile_img) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }

            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->username = $request->username;
            $user->phone = $request->phone;
            if($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->is_active = $request->is_active;
            $user->is_deleted = $request->is_deleted; 
        }
        else {
            if($request->password != null) {
                $validatedData = $request->validate([
                    'username' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'firstname' => 'required|string|max:255',
                    'password' => 'string|min:6|confirmed',
                    'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            }
            else {
                $validatedData = $request->validate([
                    'username' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'firstname' => 'required|string|max:255',
                    'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            }
    
            $user_id = $request->user_id;
            $user = User::find($user_id);
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->is_active = $request->is_active;
            $user->is_deleted = $request->is_deleted;
            // Update Profile image
            if ($request->hasFile('profile_img')){
                // Get current image path
                $oldPath = $user->profile_img;
                // Get new image
                $file = $request->file('profile_img');
                // Create image name
                $name = time() . $file->getClientOriginalName();
                // Define the new path to image
                $newFilePath = '/users/' . $name;
                // Resize new image
                $img = Image::make(file_get_contents($file))->heighten(80)->save($name);
                // Upload the new image
                $disk = Storage::disk('s3');
                $disk->put($newFilePath, $img, 'public-read');
                unlink(public_path() . '/' . $name);
                // Put in database
                $user->profile_img = $newFilePath;
                if(!empty($user->profile_img) && $disk->exists($newFilePath)){
                    $disk->delete($oldPath);
                }
            }
        }
        $user->save();
        return redirect('admin/User/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        // Delete Profile image
        $disk = Storage::disk('s3');
        $filePath = $user->profile_img;
        if(!empty($user->profile_img) && $disk->exists($filePath)){
            $disk->delete($filePath);
        }
        $user->delete();
        return redirect('admin/User/index');
    }

    public function desactivate($id)
    {
        $user = User::find($id);
        $user->is_active = false;
        $user->update();
        return redirect('admin/User/index');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->is_deleted = true;
        $user->update();
        return redirect('admin/User/index');
    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->is_active = true;
        $user->update();
        return redirect('admin/User/index');
    }
}