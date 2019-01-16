<?php

namespace App\Http\Controllers;

/*~~~~~~~~~~~___________MODELS__________~~~~~~~~~~~~*/
use DB;
use App\Event;

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
        return view('admin/Event.add', ['events' => $events]);
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

        $event->save();
        // return redirect('admin/Event/index')->with('status', 'L\'événement a été correctement ajouté.');
        return view('admin/Event.show',['event' => $event, 'id' => $event->id])->with('status', 'Le produit a été correctement ajouté.');
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
                if(!is_null($event->logo_img)){
                    unlink(public_path('uploads/'.$event->logo_img));
                }
                $logoName = time().'.'.request()->logo_img->getClientOriginalExtension();           
                request()->logo_img->move(public_path('uploads'), $logoName);

                $event->logoName = $logoName;
            } 

            if ($request->hasFile('cover_img')){
                if(!is_null($event->cover_img)){
                    unlink(public_path('uploads/'.$event->cover_img));
                }
                $cover = time().'1.'.request()->cover_img->getClientOriginalExtension();           
                request()->cover_img->move(public_path('uploads'), $cover);

                $event->cover_img = $cover;
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
                if(!is_null($event->logo_img)){
                    unlink(public_path('uploads/'.$event->logo_img));
                }
                $logoName = time().'.'.request()->logo_img->getClientOriginalExtension();           
                request()->logo_img->move(public_path('uploads'), $logoName);

                $event->logoName = $logoName;
            } 

            if ($request->hasFile('cover_img')){
                if(!is_null($event->cover_img)){
                    unlink(public_path('uploads/'.$event->cover_img));
                }
                $cover = time().'1.'.request()->cover_img->getClientOriginalExtension();           
                request()->cover_img->move(public_path('uploads'), $cover);

                $event->cover_img = $cover;
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
        if(!is_null($event->logo_img)){
            unlink(public_path('uploads/'.$event->logo_img));
        }
        if(!is_null($event->cover_img)){
            unlink(public_path('uploads/'.$event->cover_img));
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
