<?php
use App\Productvariants;
use App\Couleur;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/front/{path?}', 'app');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/', function () {
    return view('welcome');
});

/*~~~~~~~~~~~___________User Route__________~~~~~~~~~~~~*/

Route::get('admin/User/index', 'UserController@index')->name('user_index');

Route::get('admin/User/create', 'UserController@create')->name('create_user');

Route::post('admin/User/store', 'UserController@store')->name('store_user');

Route::get('admin/User/show', 'UserController@show')->name('show_user');

Route::get('admin/User/edit/{id}', 'UserController@edit')->name('edit_user');

Route::post('admin/User/update', 'UserController@update')->name('update_user');

Route::get('admin/User/destroy/{id}', 'UserController@destroy')->name('destroy_user');

Route::get('admin/User/desactivate/{id}', 'UserController@desactivate')->name('desactivate_user');

Route::get('admin/User/activate/{id}', 'UserController@activate')->name('activate_user');

/*~~~~~~~~~~~___________Products Route__________~~~~~~~~~~~~*/

Route::get('admin/Product/index', 'ProductController@index')->name('index_product');

Route::get('admin/Product/create', 'ProductController@create')->name('create_product');

Route::post('admin/Product/store', 'ProductController@store')->name('store_product');

Route::get('admin/Product/show/{id}', 'ProductController@show')->name('show_product');

Route::get('admin/Product/edit/{id}', 'ProductController@edit')->name('edit_product');

Route::post('admin/Product/update', 'ProductController@update')->name('update_product');

Route::get('admin/Product/destroy/{id}', 'ProductController@destroy')->name('destroy_product');

/*~~~~~~~~~~~___________Customers Route__________~~~~~~~~~~~~*/

Route::get('admin/Customer/index', 'CustomerController@index')->name('index_customer');

Route::get('admin/Customer/create', 'CustomerController@create')->name('create_customer');

Route::post('admin/Customer/store', 'CustomerController@store')->name('store_customer');

Route::get('admin/Customer/show/{id}', 'CustomerController@show')->name('show_customer');

Route::get('admin/Customer/edit/{id}', 'CustomerController@edit')->name('edit_customer');

Route::post('admin/Customer/update', 'CustomerController@update')->name('update_customer');

Route::get('admin/Customer/destroy/{id}', 'CustomerController@destroy')->name('destroy_customer');

/*~~~~~~~~~~~___________Events Route__________~~~~~~~~~~~~*/

Route::get('admin/Event/index', 'EventController@index')->name('index_event');

Route::get('admin/Event/create', 'EventController@create')->name('create_event');

Route::post('admin/Event/store', 'EventController@store')->name('store_event');

Route::get('admin/Event/show/{id}', 'EventController@show')->name('show_event');

Route::get('admin/Event/edit/{id}', 'EventController@edit')->name('edit_event');

Route::post('admin/Event/update', 'EventController@update')->name('update_event');

Route::get('admin/Event/destroy/{id}', 'EventController@destroy')->name('destroy_event');

Route::get('admin/Event/show/comme,t', 'CommentController@addComment')->name('comment_event');


/*~~~~~~~~~~~___________Couleurs Route__________~~~~~~~~~~~~*/

Route::get('admin/Couleur/index', 'CouleurController@index')->name('index_couleur');

Route::get('admin/Couleur/create', 'CouleurController@create')->name('create_couleur');

Route::get('admin/Couleur/createAdmin', 'CouleurController@createAdmin')->name('createAdmin_couleur');

Route::post('admin/Couleur/store', 'CouleurController@store')->name('store_couleur');

Route::post('admin/Couleur/storeAdmin', 'CouleurController@storeAdmin')->name('storeAdmin_couleur');

Route::get('admin/Couleur/show/{id}', 'CouleurController@show')->name('show_couleur');

Route::get('admin/Couleur/edit/{id}', 'CouleurController@edit')->name('edit_couleur');

Route::post('admin/Couleur/update', 'CouleurController@update')->name('update_couleur');

Route::get('admin/Couleur/destroy/{id}', 'CouleurController@destroy')->name('destroy_couleur');



/*~~~~~~~~~~~___________Tailles Route__________~~~~~~~~~~~~*/

Route::get('admin/Taille/index', 'TailleController@index')->name('index_taille');

Route::get('admin/Taille/create', 'TailleController@create')->name('create_taille');

Route::post('admin/Taille/store', 'TailleController@store')->name('store_taille');

Route::get('admin/Taille/show/{id}', 'TailleController@show')->name('show_taille');

Route::get('admin/Taille/edit/{id}', 'TailleController@edit')->name('edit_taille');

Route::post('admin/Taille/update', 'TailleController@update')->name('update_taille');

Route::get('admin/Taille/destroy/{id}', 'TailleController@destroy')->name('destroy_taille');

/*~~~~~~~~~~~___________Zones Route__________~~~~~~~~~~~~*/
Route::get('admin/Zone/index', 'ZoneController@index')->name('index_zone');

Route::get('admin/Zone/create', 'ZoneController@create')->name('create_zone');

Route::post('admin/Zone/store', 'ZoneController@store')->name('store_zone');

Route::get('admin/Zone/show/{id}', 'ZoneController@show')->name('show_zone');

Route::get('admin/Zone/edit/{id}', 'ZoneController@edit')->name('edit_zone');

Route::post('admin/Zone/update', 'ZoneController@update')->name('update_zone');

Route::get('admin/Zone/destroy/{id}', 'ZoneController@destroy')->name('destroy_zone');

/*~~~~~~~~~~~___________Comments Route__________~~~~~~~~~~~~*/
Route::post('comment/add', 'CommentController@addComment');

Route::delete('comment/delete/{id}', 'CommentController@destroy')->name('destroy_comment');

/*~~~~~~~~~~~___________Front Route__________~~~~~~~~~~~~*/
Route::get('front/{id}', 'FrontController@show')->name('show_front');

/*~~~~~~~~~~~___________Products Variants Route__________~~~~~~~~~~~~*/
Route::get('admin/Productvariants/index', 'ProductvariantsController@index')->name('index_Productvariants');

Route::get('admin/Productvariants/create/{id}', 'ProductvariantsController@create')->name('create_Productvariants');

Route::post('admin/Productvariants/store', 'ProductvariantsController@store')->name('store_Productvariants');

Route::get('admin/Productvariants/show/{id}', 'ProductvariantsController@show')->name('show_Productvariants');

Route::get('admin/Productvariants/edit/{id}', 'ProductvariantsController@edit')->name('edit_Productvariants');

Route::post('admin/Productvariants/update', 'ProductvariantsController@update')->name('update_Productvariants');

Route::get('admin/Productvariants/destroy/{id}', 'ProductvariantsController@destroy')->name('destroy_Productvariants');

/*~~~~~~~~~~~___________Events Variants Route__________~~~~~~~~~~~~*/
Route::get('admin/EventVariants/index', 'EventVariantsController@index')->name('index_eventVariants');

Route::get('admin/EventVariants/create/{id}', 'EventVariantsController@create')->name('create_eventVariants');

Route::post('admin/EventVariants/store', 'EventVariantsController@store')->name('store_eventVariants');

Route::get('admin/EventVariants/show/{id}', 'EventVariantsController@show')->name('show_eventVariants');

Route::get('admin/EventVariants/edit/{id}', 'EventVariantsController@edit')->name('edit_eventVariants');

Route::post('admin/EventVariants/update', 'EventVariantsController@update')->name('update_eventVariants');

Route::get('admin/EventVariants/destroy/{id}', 'EventVariantsController@destroy')->name('destroy_eventVariants');

// Route::get('/select_product', 'EventController@ajax/{product_id}')->name('ajax_event');

Route::get('/select_product',function(){
    $prod_id = Input::get('product_id');
    $Productvariants = Productvariants::where('product_id', '=', $prod_id)->get();
    return Response::json($Productvariants);
});

Route::get('/colors',function(){
    $color_id[] = Input::get('variants[]');
    $couleurs = Couleur::where('id', '=', $color_id)->get();
    // $Productvariants = Productvariants::all()->get();
    // return Response::json($couleurs, $Productvariants);
    return Response::json($couleurs);
});


// $couleurs = Couleurs::select('nom')
//     ->join('Productvariants', 'couleur_id', '=', 'couleurs.id')
//     ->where('couleur_id', '=', $prod_id)
//     ->get();



// Route::get('/admin/Couleur/variant_colors',function(){
//     $couleur_id[] = Input::get('variants[]');
//     //  dd($couleur_id);
//     $color = Couleur::where('id', '=', $couleur_id)->get();

//     return Response::json($color);
// });