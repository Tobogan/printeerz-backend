<?php

namespace App\Http\Controllers;

/*~~~~~~~~~~~___________MODELS__________~~~~~~~~~~~~*/
use DB;
use App\Event;
use App\Customer;
use App\Product;
use App\User;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class EventController extends Controller
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
        $events = Event::all();
        return view('admin/Event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $events = Event::all();
        $products = Product::all();
        $customers =Customer::all();
        $select_customers = [];
        foreach($customers as $customer) {
            $select_customers[$customer->id] = $customer->title;
        }
        return view('admin/Event.add', ['events' => $events, 'select_customers' => $select_customers, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(){
        $prod_id = Input::get('product_id');

        $productVariants = ProductVariants::where('product_id', '=', $prod_id)->get();

        return Response::json($productVariants);
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
            'advertiser' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'max:750'
        ]);

        $event = new Event;

        $event->name = $request->name;
        $event->advertiser = $request->advertiser;
        $event->customer_id = $request->customer_id;
        $event->location = array(
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'lattitude' => $request->lattitude
        );
        $event->start_datetime = $request->start_datetime;
        $event->end_datetime = $request->end_datetime;
        $event->type = $request->type;
        $event->description = $request->description;

        $event_products_id[]=$request->get('event_products_id');
        $event->event_products_id=$event_products_id;

        $employees[]=$request->get('employees');
        $event->employees=$employees;

        $event->comments = array(
            'id' => $request->comment_id,
            'employee_id' => $request->employee_id,
            'comment' => $request->comment,
            'created_at' => $request->created_at
        );

        $event->save();

/*~~~~~~~~~~~___________UPLOADS IMAGES__________~~~~~~~~~~~~*/
        if ($request->hasFile('logo_img')){
            $logoName = time().'.'.request()->logo_img->getClientOriginalExtension();           
            request()->logo_img->move(public_path('uploads'), $logoName);

            $event->logoName = $logoName;
        } 

        if ($request->hasFile('cover_img')){
            $cover = time().'1.'.request()->cover_img->getClientOriginalExtension();           
            request()->cover_img->move(public_path('uploads'), $cover);

            $event->cover_img = $cover;
        } 

        if ($request->hasFile('BAT')){
            $bat_file = time().'2.'.request()->BAT->getClientOriginalExtension();           
            request()->BAT->move(public_path('uploads'), $bat_file);

            $event->BAT = $bat_file;
        } 

        $event->save();
        return redirect('admin/Event/index')->with('status', 'L\'événement a été correctement ajouté.');
        //return view('admin/Event.show',['event' => $event, 'id' => $event->id])->with('status', 'Le produit a été correctement ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('admin/Event.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_eventVariants($id)
    {
        $event = Event::find($id);
        $eventVariants = EventVariants::all();
        $productVariants = ProductVariants::all();
        return view('admin/Event.show_eventVariants', ['event' => $event, 'productVariants' => $productVariants, 'eventVariants' => $eventVariants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        
        return view('admin/Event.edit', ['event' => $event]);
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
        if (request('actual_name') == request('name')){
            $validatedData = $request->validate([
                'advertiser' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);

            $event->name = $request->name;
            $event->advertiser = $request->advertiser;
            $event->customer_id = $request->customer_id;
            $event->location = array(
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
                'longitude' => $request->longitude,
                'lattitude' => $request->lattitude
            );
            $event->start_datetime = $request->start_datetime;
            $event->end_datetime = $request->end_datetime;
            $event->type = $request->type;
            $event->description = $request->description;

            $event_products_id[]=$request->get('event_products_id');
            $event->event_products_id=$event_products_id;

            $employees[]=$request->get('employees');
            $event->employees=$employees;

            $event->comments = array(
                'id' => $request->comment_id,
                'employee_id' => $request->employee_id,
                'comment' => $request->comment,
                'created_at' => $request->created_at
            );

            $event->save();

            /*~~~~~~~~~~~___________UPLOADS IMAGES__________~~~~~~~~~~~~*/
            if ($request->hasFile('logo_img')){
            $file_path_logo_img = public_path('uploads/'.$event->logo_img);
            if(file_exists(public_path('uploads/'.$event->logo_img)) && !empty($event->logo_img)){
                unlink($file_path_logo_img);
            }
            $logoName = time().'.'.request()->logo_img->getClientOriginalExtension();           
            request()->logo_img->move(public_path('uploads'), $logoName);

            $event->logoName = $logoName;
        } 

        if ($request->hasFile('cover_img')){
            $file_path_cover_img = public_path('uploads/'.$event->cover_img);
            if(file_exists(public_path('uploads/'.$event->cover_img)) && !empty($event->cover_img)){
                unlink($file_path_cover_img);
            }
            $cover = time().'1.'.request()->cover_img->getClientOriginalExtension();           
            request()->cover_img->move(public_path('uploads'), $cover);

            $event->cover_img = $cover;
        }

        if ($request->hasFile('BAT')){
            $file_path_BAT = public_path('uploads/'.$event->BAT);
            if(file_exists(public_path('uploads/'.$event->BAT)) && !empty($event->BAT)){
                unlink($file_path_BAT);
            }
            $bat_file = time().'2.'.request()->BAT->getClientOriginalExtension();           
            request()->BAT->move(public_path('uploads'), $bat_file);

            $event->BAT = $bat_file;
        }

            $event->save();
        }        
        else{
            $validatedData = $request->validate([
                'advertiser' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);

            $event->name = $request->name;
            $event->advertiser = $request->advertiser;
            $event->customer_id = $request->customer_id;
            $event->location = array(
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
                'longitude' => $request->longitude,
                'lattitude' => $request->lattitude
            );
            $event->start_datetime = $request->start_datetime;
            $event->end_datetime = $request->end_datetime;
            $event->type = $request->type;
            $event->description = $request->description;

            $event_products_id[]=$request->get('event_products_id');
            $event->event_products_id=$event_products_id;

            $employees[]=$request->get('employees');
            $event->employees=$employees;

            $event->comments = array(
                'id' => $request->comment_id,
                'employee_id' => $request->employee_id,
                'comment' => $request->comment,
                'created_at' => $request->created_at
            );

            $event->save();

    /*~~~~~~~~~~~___________UPLOADS IMAGES__________~~~~~~~~~~~~*/
            if ($request->hasFile('logo_img')){
                $file_path_logo_img = public_path('uploads/'.$event->logo_img);
                if(file_exists(public_path('uploads/'.$event->logo_img)) && !empty($event->logo_img)){
                    unlink($file_path_logo_img);
                }
                $logoName = time().'.'.request()->logo_img->getClientOriginalExtension();           
                request()->logo_img->move(public_path('uploads'), $logoName);

                $event->logoName = $logoName;
            } 

            if ($request->hasFile('cover_img')){
                $file_path_cover_img = public_path('uploads/'.$event->cover_img);
                if(file_exists(public_path('uploads/'.$event->cover_img)) && !empty($event->cover_img)){
                    unlink($file_path_cover_img);
                }
                $cover = time().'1.'.request()->cover_img->getClientOriginalExtension();           
                request()->cover_img->move(public_path('uploads'), $cover);

                $event->cover_img = $cover;
            }

            if ($request->hasFile('BAT')){
                $file_path_BAT = public_path('uploads/'.$event->BAT);
                if(file_exists(public_path('uploads/'.$event->BAT)) && !empty($event->BAT)){
                    unlink($file_path_BAT);
                }
                $bat_file = time().'2.'.request()->BAT->getClientOriginalExtension();           
                request()->BAT->move(public_path('uploads'), $bat_file);

                $event->BAT = $bat_file;
            }

            $event->save();
        }
        return redirect('admin/Event/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $file_path_logo_img = public_path('uploads/'.$event->logo_img);
        if(file_exists(public_path('uploads/'.$event->logo_img)) && !empty($event->logo_img)){
            unlink($file_path_logo_img);
        }
        $file_path_cover_img = public_path('uploads/'.$event->cover_img);
        if(file_exists(public_path('uploads/'.$event->cover_img)) && !empty($event->cover_img)){
            unlink($file_path_cover_img);
        }
        $file_path_BAT = public_path('uploads/'.$event->BAT);
        if(file_exists(public_path('uploads/'.$event->BAT)) && !empty($event->BAT)){
            unlink($file_path_BAT);
        }
        $event->delete();
        return redirect('admin/Event/index');
    }

    /*--~~~~~~~~~~~___________activate and desactivate a event function in index event__________~~~~~~~~~~~~-*/
    public function desactivate($id)
    {
        $event = Event::find($id);
        $event->is_active = false;
        $event->update();
        return redirect('admin/Event/index');
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $event->is_deleted = true;
        $event->update();
        return redirect('admin/Event/index');
    }

    public function activate($id)
    {
        $event = Event::find($id);
        $event->is_active = true;
        $event->update();
        return redirect('admin/Event/index');
    }
}
