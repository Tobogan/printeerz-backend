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
        $this->middleware(isActivate::class);
        $this->middleware(isAdmin::class);
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user = new User;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        if ($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $imageName);

            $user->imageName = $imageName;
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
        return view('admin/user.show', ['user' => $user]);
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
            $validatedData = $request->validate([
                'nom' => 'string|max:255',
                'prenom' => 'string|max:255',
                'email' => 'string|email|max:255',
                'password' => 'string|min:6|confirmed'
                //'image' => 'required'
            ]);
            $id = $request->id;
            $user = User::find($id);
            if(!is_null($user->imageName)){
                Storage::delete('uploads' . $user->imageName);
            }

            if($request->file('image')){
                if ($request->file('image')->isValid()){
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();           
                    request()->image->move(public_path('uploads'), $imageName);
    
                    $user->imageName = $imageName;
                }
            }
            
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;  
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'string|max:255',
                'prenom' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users',
                'password' => 'string|min:6|confirmed'
            ]);
    
            $id = $request->id;
            $user = User::find($id);

            if(!is_null($user->imageName)){
                Storage::delete('uploads' . $user->imageName);
            }
            if($request->file('image')){
                if ($request->file('image')->isValid()){
                    $imageName = time().'.'.request()->image->getClientOriginalExtension();           
                    request()->image->move(public_path('uploads'), $imageName);
    
                    $user->imageName = $imageName;
                }
            }

            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            if ($request->hasFile('image')){// delete l'ancienne photo 
                $image = $request->image;
                $imageName = time().'.'.$image->getClientOriginalExtension();            
                request()->image->move(public_path('uploads'), $imageName);
                $oldImageName = $user->image;
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
        Storage::delete('uploads' . $user->imageName);
        $user->delete();
        return redirect('admin/User/index');
    }

    public function desactivate($id)
    {
        $user = User::find($id);
        $user->activate = 0;
        $user->update();
        return redirect('admin/User/index');
    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->activate = 1;
        $user->update();
        return redirect('admin/User/index');
    }
}