<?php

namespace App\Http\Controllers;

/*~~~~~~~~~~~___________MODELS__________~~~~~~~~~~~~*/
use DB;
use App\Event;
use App\Customer;
use App\Product;
use App\ImageZone;
use App\Couleur;
use App\Gabarit;
use App\User;

use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isActivate;

class EventController extends Controller
{
    public function __construct(){
        $this->middleware(isActivate::class);
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
        $customers = Customer::all();
        $select = [];
        foreach($customers as $customer){
            $select[$customer->id] = $customer->denomination;
        }
        $products = Product::all();
        $select_products = [];
        foreach($products as $product){
            if(($product->color_FAV == 1) && ($product->color_coeur == 1 ) && ($product->color_FAR == 1)){
                $select_products[$product->id] = $product->nom . ' (Face avant, Coeur, Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 1 && $product->color_coeur == 0 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Face avant) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 1 && $product->color_coeur == 1 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Face avant, Coeur) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 1 && $product->color_FAR == 1){
                $select_products[$product->id] = $product->nom . ' (Coeur, Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 0 && $product->color_FAR == 1){
                $select_products[$product->id] = $product->nom . ' (Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 1 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Coeur) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 0 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Aucune zone) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
        }
        $gabarits = Gabarit::all();
        $select_gabarits = [];
        foreach($gabarits as $gabarit){
            $select_gabarits[$gabarit->id] = $gabarit->nom;
        }
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/Event.add', ['select' => $select, 'select_couleurs' => $select_couleurs, 'select_gabarits' => $select_gabarits, 'select_products' => $select_products, 'products' => $products]);
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
            'annonceur' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lieu' => 'required|string|max:255',
            'description' => 'max:750'
        ]);

        $event = new Event;
        $event->nom = $request->nom;
        $event->annonceur = $request->annonceur;
        $event->customer_id = $request->customer_id;
        $event->save();
        $event->product_id = $request->product_id;
        $event->users()->sync($request->get('users_list'));
        $event->lieu = $request->lieu;
        $event->type = $request->type;
        $event->date = $request->date;
        $event->description = $request->description;

/*~~~~~~~~~~~___________NOMS DE COULEURS__________~~~~~~~~~~~~*/
        $event->color1 = $request->color1;
        $event->color2 = $request->color2;
        $event->color3 = $request->color3;

/*~~~~~~~~~~~___________NUMERO DU GABARIT__________~~~~~~~~~~~~*/
        $event->color1_FAV_gabarit = $request->color1_FAV_gabarit;
        $event->color2_FAV_gabarit = $request->color2_FAV_gabarit;
        $event->color3_FAV_gabarit = $request->color3_FAV_gabarit;

        $event->color1_FAR_gabarit = $request->color1_FAR_gabarit;
        $event->color2_FAR_gabarit = $request->color2_FAR_gabarit;
        $event->color3_FAR_gabarit = $request->color3_FAR_gabarit;

        $event->color1_coeur_gabarit = $request->color1_coeur_gabarit;
        $event->color2_coeur_gabarit = $request->color2_coeur_gabarit;
        $event->color3_coeur_gabarit = $request->color3_coeur_gabarit;
        $event->save();

/*~~~~~~~~~~~___________UPLOADS IMAGES__________~~~~~~~~~~~~*/
        if ($request->hasFile('image')){
            $logoName = time().'.'.request()->image->getClientOriginalExtension();           
            request()->image->move(public_path('uploads'), $logoName);

            $event->logoName = $logoName;
        } 

        if ($request->hasFile('image1')){
            $imageName1 = time().'1.'.request()->image1->getClientOriginalExtension();           
            request()->image1->move(public_path('uploads'), $imageName1);

            $event->imageName1 = $imageName1;
        } 

        if ($request->hasFile('image2')){
            $imageName2 = time().'2.'.request()->image2->getClientOriginalExtension();           
            request()->image2->move(public_path('uploads'), $imageName2);

            $event->imageName2 = $imageName2;
        } 

        if ($request->hasFile('image3')){
            $accueil_imageName = time().'3.'.request()->image3->getClientOriginalExtension();           
            request()->image3->move(public_path('uploads'), $accueil_imageName);

            $event->accueil_imageName = $accueil_imageName;
        } 

        if ($request->hasFile('image4')){
            $veille_imageName = time().'4.'.request()->image4->getClientOriginalExtension();           
            request()->image4->move(public_path('uploads'), $veille_imageName);

            $event->veille_imageName = $veille_imageName;
        } 

        if ($request->hasFile('BAT')){
            $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
            request()->BAT->move(public_path('uploads'), $BAT_name);

            $event->BAT_name = $BAT_name;
        } 

/*~~~~~~~~~~~___________REQUEST ZONE FAV__________~~~~~~~~~~~~*/
        if($request->color1_FAV)
            $event->color1_FAV = 1;
        if($request->color2_FAV)
            $event->color2_FAV = 1;
        if($request->color3_FAV)
            $event->color3_FAV = 1;

/*~~~~~~~~~~~___________REQUEST ZONE FAR__________~~~~~~~~~~~~*/
        if($request->color1_FAR)
            $event->color1_FAR = 1;
        if($request->color2_FAR)
            $event->color2_FAR = 1;
        if($request->color3_FAR)
            $event->color3_FAR = 1;

/*~~~~~~~~~~~___________REQUEST ZONE COEUR__________~~~~~~~~~~~~*/
        if($request->color1_coeur)
            $event->color1_coeur = 1;
        if($request->color2_coeur)
            $event->color2_coeur = 1;
        if($request->color3_coeur)
            $event->color3_coeur = 1;

/*~~~~~~~~~~~___________IMAGES COLOR1__________~~~~~~~~~~~~*/
        if ($request->hasFile('color1_coeur_image')){
            $color1_coeur_imageName = time().'1.'.request()->color1_coeur_image->getClientOriginalExtension();           
            request()->color1_coeur_image->move(public_path('uploads'), $color1_coeur_imageName);

            $event->color1_coeur_imageName = $color1_coeur_imageName;
        }

        if ($request->hasFile('color1_FAV_image')){
            $color1_FAV_imageName = time().'2.'.request()->color1_FAV_image->getClientOriginalExtension();           
            request()->color1_FAV_image->move(public_path('uploads'), $color1_FAV_imageName);

            $event->color1_FAV_imageName = $color1_FAV_imageName;
        }

        if ($request->hasFile('color1_FAR_image')){
            $color1_FAR_imageName = time().'3.'.request()->color1_FAR_image->getClientOriginalExtension();           
            request()->color1_FAR_image->move(public_path('uploads'), $color1_FAR_imageName);

            $event->color1_FAR_imageName = $color1_FAR_imageName;
        }

/*~~~~~~~~~~~___________IMAGES COLOR2__________~~~~~~~~~~~~*/
        if ($request->hasFile('color2_coeur_image')){
            $color2_coeur_imageName = time().'4.'.request()->color2_coeur_image->getClientOriginalExtension();           
            request()->color2_coeur_image->move(public_path('uploads'), $color2_coeur_imageName);

            $event->color2_coeur_imageName = $color2_coeur_imageName;
        }

        if ($request->hasFile('color2_FAV_image')){
            $color2_FAV_imageName = time().'5.'.request()->color2_FAV_image->getClientOriginalExtension();           
            request()->color2_FAV_image->move(public_path('uploads'), $color2_FAV_imageName);

            $event->color2_FAV_imageName = $color2_FAV_imageName;
        }

        if ($request->hasFile('color2_FAR_image')){
            $color2_FAR_imageName = time().'6.'.request()->color2_FAR_image->getClientOriginalExtension();           
            request()->color2_FAR_image->move(public_path('uploads'), $color2_FAR_imageName);

            $event->color2_FAR_imageName = $color2_FAR_imageName;
        }

/*~~~~~~~~~~~___________IMAGES COLOR3__________~~~~~~~~~~~~*/
        if ($request->hasFile('color3_coeur_image')){
            $color3_coeur_imageName = time().'7.'.request()->color3_coeur_image->getClientOriginalExtension();           
            request()->color3_coeur_image->move(public_path('uploads'), $color3_coeur_imageName);

            $event->color3_coeur_imageName = $color3_coeur_imageName;
        }

        if ($request->hasFile('color3_FAV_image')){
            $color3_FAV_imageName = time().'8.'.request()->color3_FAV_image->getClientOriginalExtension();           
            request()->color3_FAV_image->move(public_path('uploads'), $color3_FAV_imageName);

            $event->color3_FAV_imageName = $color3_FAV_imageName;
        }

        if ($request->hasFile('color3_FAR_image')){
            $color3_FAR_imageName = time().'9.'.request()->color3_FAR_image->getClientOriginalExtension();           
            request()->color3_FAR_image->move(public_path('uploads'), $color3_FAR_imageName);

            $event->color3_FAR_imageName = $color3_FAR_imageName;
        }

        $event->save();
        return redirect('admin/Event/index');
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
        $product = Product::find($id);
        $couleurs = Couleur::all();
        $user = User::find($id);
        return view('admin/Event.show', ['event' => $event, 'couleurs' => $couleurs, 'product' => $product, 'user' => $user]);
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
        $customers = Customer::all();
        $products = Product::all();
        $select = [];
        foreach($customers as $customer){
            $select[$customer->id] = $customer->denomination;
        }
        $select_products = [];
        foreach($products as $product){
            if(($product->color_FAV == 1) && ($product->color_coeur == 1 ) && ($product->color_FAR == 1)){
                $select_products[$product->id] = $product->nom . ' (Face avant, Coeur, Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 1 && $product->color_coeur == 0 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Face avant) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 1 && $product->color_coeur == 1 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Face avant, Coeur) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 1 && $product->color_FAR == 1){
                $select_products[$product->id] = $product->nom . ' (Coeur, Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 0 && $product->color_FAR == 1){
                $select_products[$product->id] = $product->nom . ' (Face arrière) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 1 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Coeur) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
            if($product->color_FAV == 0 && $product->color_coeur == 0 && $product->color_FAR == 0){
                $select_products[$product->id] = $product->nom . ' (Aucune zone) - ' . implode(', ', $product->couleurs->pluck('nom')->toArray());
            }
        }
        $gabarits = Gabarit::all();
        $select_gabarits = [];
        foreach($gabarits as $gabarit){
            $select_gabarits[$gabarit->id] = $gabarit->nom;
        }
        $couleurs = Couleur::all();
        $select_couleurs = [];
        foreach($couleurs as $couleur){
            $select_couleurs[$couleur->id] = $couleur->nom;
        }
        return view('admin/Event.edit', ['event' => $event, 'products' => $products, 'select_gabarits' => $select_gabarits,'select' => $select, 'select_products' => $select_products, 'select_couleurs' => $select_couleurs]);
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
        if (request('actual_nom') == request('nom')){
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'annonceur' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lieu' => 'required|string|max:255',
                'description' => 'max:750'
            ]);
            $id = $request->id;
            $event = Event::find($id);

            $event->nom = $request->nom;
            $event->annonceur = $request->annonceur;
            $event->customer_id = $request->customer_id;
            $event->save();
            $event->product_id = $request->product_id;
            $event->users()->sync($request->get('users_list'));
            $event->lieu = $request->lieu;
            $event->type = $request->type;
            $event->date = $request->date;
            $event->description = $request->description;

            $event->color1 = $request->color1;
            $event->color2 = $request->color2;
            $event->color3 = $request->color3;

            $event->color1_FAV_gabarit = $request->color1_FAV_gabarit;
            $event->color2_FAV_gabarit = $request->color2_FAV_gabarit;
            $event->color3_FAV_gabarit = $request->color3_FAV_gabarit;

            $event->color1_FAR_gabarit = $request->color1_FAR_gabarit;
            $event->color2_FAR_gabarit = $request->color2_FAR_gabarit;
            $event->color3_FAR_gabarit = $request->color3_FAR_gabarit;

            $event->color1_coeur_gabarit = $request->color1_coeur_gabarit;
            $event->color2_coeur_gabarit = $request->color2_coeur_gabarit;
            $event->color3_coeur_gabarit = $request->color3_coeur_gabarit;
            $event->save();

            if ($request->hasFile('image')){
                $logoName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $logoName);
                $event->logoName = $logoName;
            } 

            if ($request->hasFile('image1')){
                $imageName1 = time().'1.'.request()->image1->getClientOriginalExtension();           
                request()->image1->move(public_path('uploads'), $imageName1);
                $event->imageName1 = $imageName1;
            } 

            if ($request->hasFile('image2')){
                $imageName2 = time().'2.'.request()->image2->getClientOriginalExtension();           
                request()->image2->move(public_path('uploads'), $imageName2);
                $event->imageName2 = $imageName2;
            } 

            if ($request->hasFile('image3')){
                $accueil_imageName = time().'3.'.request()->image3->getClientOriginalExtension();           
                request()->image3->move(public_path('uploads'), $accueil_imageName);
                $event->accueil_imageName = $accueil_imageName;
            } 

            if ($request->hasFile('image4')){
                $veille_imageName = time().'4.'.request()->image4->getClientOriginalExtension();           
                request()->image4->move(public_path('uploads'), $veille_imageName);
                $event->veille_imageName = $veille_imageName;
            } 

            if ($request->hasFile('BAT')){
                $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
                request()->BAT->move(public_path('uploads'), $BAT_name);
                $event->BAT_name = $BAT_name;
            } 

            /*~~~~~~~~~~~___________REQUEST ZONE FAV__________~~~~~~~~~~~~*/
            if($request->color1_FAV)
                $event->color1_FAV = 1;
            if($request->color2_FAV)
                $event->color2_FAV = 1;
            if($request->color3_FAV)
                $event->color3_FAV = 1;

            /*~~~~~~~~~~~___________REQUEST ZONE FAR__________~~~~~~~~~~~~*/
            if($request->color1_FAR)
                $event->color1_FAR = 1;
            if($request->color2_FAR)
                $event->color2_FAR = 1;
            if($request->color3_FAR)
                $event->color3_FAR = 1;

            /*~~~~~~~~~~~___________REQUEST ZONE COEUR__________~~~~~~~~~~~~*/
            if($request->color1_coeur)
                $event->color1_coeur = 1;
            if($request->color2_coeur)
                $event->color2_coeur = 1;
            if($request->color3_coeur)
                $event->color3_coeur = 1;

            /*~~~~~~~~~~~___________Image color1__________~~~~~~~~~~~~*/
            if ($request->hasFile('color1_coeur_image')){
                $color1_coeur_imageName = time().'1.'.request()->color1_coeur_image->getClientOriginalExtension();           
                request()->color1_coeur_image->move(public_path('uploads'), $color1_coeur_imageName);
                $event->color1_coeur_imageName = $color1_coeur_imageName;
            }
            if ($request->hasFile('color1_FAV_image')){
                $color1_FAV_imageName = time().'2.'.request()->color1_FAV_image->getClientOriginalExtension();           
                request()->color1_FAV_image->move(public_path('uploads'), $color1_FAV_imageName);
                $event->color1_FAV_imageName = $color1_FAV_imageName;
            }
            if ($request->hasFile('color1_FAR_image')){
                $color1_FAR_imageName = time().'3.'.request()->color1_FAR_image->getClientOriginalExtension();           
                request()->color1_FAR_image->move(public_path('uploads'), $color1_FAR_imageName);
                $event->color1_FAR_imageName = $color1_FAR_imageName;
            }

            /*~~~~~~~~~~~___________Images color2__________~~~~~~~~~~~~*/
            if ($request->hasFile('color2_coeur_image')){
                $color2_coeur_imageName = time().'4.'.request()->color2_coeur_image->getClientOriginalExtension();           
                request()->color2_coeur_image->move(public_path('uploads'), $color2_coeur_imageName);
                $event->color2_coeur_imageName = $color2_coeur_imageName;
            }
            if ($request->hasFile('color2_FAV_image')){
                $color2_FAV_imageName = time().'5.'.request()->color2_FAV_image->getClientOriginalExtension();           
                request()->color2_FAV_image->move(public_path('uploads'), $color2_FAV_imageName);
                $event->color2_FAV_imageName = $color2_FAV_imageName;
            }
            if ($request->hasFile('color2_FAR_image')){
                $color2_FAR_imageName = time().'6.'.request()->color2_FAR_image->getClientOriginalExtension();           
                request()->color2_FAR_image->move(public_path('uploads'), $color2_FAR_imageName);
                $event->color2_FAR_imageName = $color2_FAR_imageName;
            }

            /*~~~~~~~~~~~___________Images color3__________~~~~~~~~~~~~*/
            if ($request->hasFile('color3_coeur_image')){
                $color3_coeur_imageName = time().'7.'.request()->color3_coeur_image->getClientOriginalExtension();           
                request()->color3_coeur_image->move(public_path('uploads'), $color3_coeur_imageName);
                $event->color3_coeur_imageName = $color3_coeur_imageName;
            }
            if ($request->hasFile('color3_FAV_image')){
                $color3_FAV_imageName = time().'8.'.request()->color3_FAV_image->getClientOriginalExtension();           
                request()->color3_FAV_image->move(public_path('uploads'), $color3_FAV_imageName);
                $event->color3_FAV_imageName = $color3_FAV_imageName;
            }
            if ($request->hasFile('color3_FAR_image')){
                $color3_FAR_imageName = time().'9.'.request()->color3_FAR_image->getClientOriginalExtension();           
                request()->color3_FAR_image->move(public_path('uploads'), $color3_FAR_imageName);
                $event->color3_FAR_imageName = $color3_FAR_imageName;
            }

        $event->save();
        }        
        else{
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'annonceur' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'lieu' => 'required|string|max:255',
                'description' => 'max:750'
            ]);

            $id = $request->id;
            $event = Event::find($id);

            $event->nom = $request->nom;
            $event->annonceur = $request->annonceur;
            $event->customer_id = $request->customer_id;
            $event->save();
            $event->product_id = $request->product_id;
            $event->users()->sync($request->get('users_list'));
            $event->lieu = $request->lieu;
            $event->type = $request->type;
            $event->date = $request->date;
            $event->description = $request->description;

            $event->color1 = $request->color1;
            $event->color2 = $request->color2;
            $event->color3 = $request->color3;

            $event->color1_FAV_gabarit = $request->color1_FAV_gabarit;
            $event->color2_FAV_gabarit = $request->color2_FAV_gabarit;
            $event->color3_FAV_gabarit = $request->color3_FAV_gabarit;

            $event->color1_FAR_gabarit = $request->color1_FAR_gabarit;
            $event->color2_FAR_gabarit = $request->color2_FAR_gabarit;
            $event->color3_FAR_gabarit = $request->color3_FAR_gabarit;

            $event->color1_coeur_gabarit = $request->color1_coeur_gabarit;
            $event->color2_coeur_gabarit = $request->color2_coeur_gabarit;
            $event->color3_coeur_gabarit = $request->color3_coeur_gabarit;
            $event->save();

            if ($request->hasFile('image')){
                $logoName = time().'.'.request()->image->getClientOriginalExtension();           
                request()->image->move(public_path('uploads'), $logoName);
                $event->logoName = $logoName;
            } 

            if ($request->hasFile('image1')){
                $imageName1 = time().'1.'.request()->image1->getClientOriginalExtension();           
                request()->image1->move(public_path('uploads'), $imageName1);
                $event->imageName1 = $imageName1;
            } 

            if ($request->hasFile('image2')){
                $imageName2 = time().'2.'.request()->image2->getClientOriginalExtension();           
                request()->image2->move(public_path('uploads'), $imageName2);
                $event->imageName2 = $imageName2;
            } 

            if ($request->hasFile('image3')){
                $accueil_imageName = time().'3.'.request()->image3->getClientOriginalExtension();           
                request()->image3->move(public_path('uploads'), $accueil_imageName);
                $event->accueil_imageName = $accueil_imageName;
            } 

            if ($request->hasFile('image4')){
                $veille_imageName = time().'4.'.request()->image4->getClientOriginalExtension();           
                request()->image4->move(public_path('uploads'), $veille_imageName);
                $event->veille_imageName = $veille_imageName;
            } 

            if ($request->hasFile('BAT')){
                $BAT_name = time().'5.'.request()->BAT->getClientOriginalExtension();           
                request()->BAT->move(public_path('uploads'), $BAT_name);
                $event->BAT_name = $BAT_name;
            } 

            /*~~~~~~~~~~~___________REQUEST ZONE FAV__________~~~~~~~~~~~~*/
            if($request->color1_FAV)
                $event->color1_FAV = 1;
            if($request->color2_FAV)
                $event->color2_FAV = 1;
            if($request->color3_FAV)
                $event->color3_FAV = 1;

            /*~~~~~~~~~~~___________REQUEST ZONE FAR__________~~~~~~~~~~~~*/
            if($request->color1_FAR)
                $event->color1_FAR = 1;
            if($request->color2_FAR)
                $event->color2_FAR = 1;
            if($request->color3_FAR)
                $event->color3_FAR = 1;

            /*~~~~~~~~~~~___________REQUEST ZONE COEUR__________~~~~~~~~~~~~*/
            if($request->color1_coeur)
                $event->color1_coeur = 1;
            if($request->color2_coeur)
                $event->color2_coeur = 1;
            if($request->color3_coeur)
                $event->color3_coeur = 1;

            /*~~~~~~~~~~~___________Image color1__________~~~~~~~~~~~~*/
            if ($request->hasFile('color1_coeur_image')){
                $color1_coeur_imageName = time().'1.'.request()->color1_coeur_image->getClientOriginalExtension();           
                request()->color1_coeur_image->move(public_path('uploads'), $color1_coeur_imageName);
                $event->color1_coeur_imageName = $color1_coeur_imageName;
            }
            if ($request->hasFile('color1_FAV_image')){
                $color1_FAV_imageName = time().'2.'.request()->color1_FAV_image->getClientOriginalExtension();           
                request()->color1_FAV_image->move(public_path('uploads'), $color1_FAV_imageName);
                $event->color1_FAV_imageName = $color1_FAV_imageName;
            }
            if ($request->hasFile('color1_FAR_image')){
                $color1_FAR_imageName = time().'3.'.request()->color1_FAR_image->getClientOriginalExtension();           
                request()->color1_FAR_image->move(public_path('uploads'), $color1_FAR_imageName);
                $event->color1_FAR_imageName = $color1_FAR_imageName;
            }

            /*~~~~~~~~~~~___________Images color2__________~~~~~~~~~~~~*/
            if ($request->hasFile('color2_coeur_image')){
                $color2_coeur_imageName = time().'4.'.request()->color2_coeur_image->getClientOriginalExtension();           
                request()->color2_coeur_image->move(public_path('uploads'), $color2_coeur_imageName);
                $event->color2_coeur_imageName = $color2_coeur_imageName;
            }
            if ($request->hasFile('color2_FAV_image')){
                $color2_FAV_imageName = time().'5.'.request()->color2_FAV_image->getClientOriginalExtension();           
                request()->color2_FAV_image->move(public_path('uploads'), $color2_FAV_imageName);
                $event->color2_FAV_imageName = $color2_FAV_imageName;
            }
            if ($request->hasFile('color2_FAR_image')){
                $color2_FAR_imageName = time().'6.'.request()->color2_FAR_image->getClientOriginalExtension();           
                request()->color2_FAR_image->move(public_path('uploads'), $color2_FAR_imageName);
                $event->color2_FAR_imageName = $color2_FAR_imageName;
            }

            /*~~~~~~~~~~~___________Images color3__________~~~~~~~~~~~~*/
            if ($request->hasFile('color3_coeur_image')){
                $color3_coeur_imageName = time().'7.'.request()->color3_coeur_image->getClientOriginalExtension();           
                request()->color3_coeur_image->move(public_path('uploads'), $color3_coeur_imageName);
                $event->color3_coeur_imageName = $color3_coeur_imageName;
            }
            if ($request->hasFile('color3_FAV_image')){
                $color3_FAV_imageName = time().'8.'.request()->color3_FAV_image->getClientOriginalExtension();           
                request()->color3_FAV_image->move(public_path('uploads'), $color3_FAV_imageName);
                $event->color3_FAV_imageName = $color3_FAV_imageName;
            }
            if ($request->hasFile('color3_FAR_image')){
                $color3_FAR_imageName = time().'9.'.request()->color3_FAR_image->getClientOriginalExtension();           
                request()->color3_FAR_image->move(public_path('uploads'), $color3_FAR_imageName);
                $event->color3_FAR_imageName = $color3_FAR_imageName;
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

        $event->delete();
        return redirect('admin/Event/index');
    }
}
