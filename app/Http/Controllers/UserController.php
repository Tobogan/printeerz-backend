<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

use Image;
use Illuminate\Support\Facades\Storage;
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
        return view('admin/User.index', ['users' => $users]);
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
            'SIREN' => 'string|max:14',
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
        $user->is_active = $request->is_active; // penser à mettre l'input hidden
        $user->is_deleted = $request->is_deleted;

        /*--~~~~~~~~~~~___________Upload img__________~~~~~~~~~~~~-*/
        if ($request->hasFile('profile_img')){
            $profile_img = time().'.'.request()->profile_img->getClientOriginalExtension();
            request()->profile_img->move(public_path('uploads'), $profile_img);
            $user->profile_img = $profile_img;
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

            /*--~~~~~~~~~~~___________Upload img & delete old img__________~~~~~~~~~~~~-*/
            if ($request->hasFile('profile_img')){
                $file_path_profile_img = public_path('uploads/'.$user->profile_img);
                if(file_exists(public_path('uploads/'.$user->profile_img)) && !empty($user->profile_img)){
                    unlink($file_path_profile_img);
                }
                $imageName = time().'.'.request()->profile_img->getClientOriginalExtension();
                request()->profile_img->move(public_path('uploads'), $imageName);
    
                $user->profile_img = $imageName;
            }

            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->username = $request->username;
            if($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->is_active = $request->is_active;
            $user->is_deleted = $request->is_deleted; 
        }
        else{
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
    
            $id = $request->id;
            $user = User::find($id);

            /*--~~~~~~~~~~~___________Upload img & delete old img__________~~~~~~~~~~~~-*/
            if ($request->hasFile('profile_img')){
                $file_path_profile_img = public_path('uploads/'.$user->profile_img);
                if(file_exists(public_path('uploads/'.$user->profile_img)) && !empty($user->profile_img)){
                    unlink($file_path_profile_img);
                }
                $imageName = time().'.'.request()->profile_img->getClientOriginalExtension();
                request()->profile_img->move(public_path('uploads'), $imageName);
    
                $user->profile_img = $imageName;
            }

            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->is_active = $request->is_active;
            $user->is_deleted = $request->is_deleted; 
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
        $file_path_profile_img = public_path('uploads/'.$user->profile_img);
        if(file_exists(public_path('uploads/'.$user->profile_img)) && !empty($user->profile_img)){
            unlink($file_path_profile_img);
        }
        $user->delete();
        return redirect('admin/User/index');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a user function in index User__________~~~~~~~~~~~~-*/
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