<?php
use App\ProductVariants;
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
    return view('home');
});

/*~~~~~~~~~~~___________User Route__________~~~~~~~~~~~~*/

Route::get('admin/User/index', 'UserController@index')->name('user_index');

Route::get('admin/User/create', 'UserController@create')->name('create_user');

Route::post('admin/User/store', 'UserController@store')->name('store_user');

Route::get('admin/User/show/{id}', 'UserController@show')->name('show_user');

Route::get('admin/User/edit/{id}', 'UserController@edit')->name('edit_user');

Route::post('admin/User/update', 'UserController@update')->name('update_user');

Route::get('admin/User/destroy/{id}', 'UserController@destroy')->name('destroy_user');

Route::get('admin/User/delete/{id}', 'UserController@delete')->name('delete_user');

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

Route::get('admin/Product/delete/{id}', 'ProductController@delete')->name('delete_product');

Route::get('admin/Product/desactivate/{id}', 'ProductController@desactivate')->name('desactivate_product');

Route::get('admin/Product/activate/{id}', 'ProductController@activate')->name('activate_product');

/*~~~~~~~~~~~___________Customers Route__________~~~~~~~~~~~~*/

Route::get('admin/Customer/index', 'CustomerController@index')->name('index_customer');

Route::get('admin/Customer/create', 'CustomerController@create')->name('create_customer');

Route::post('admin/Customer/store', 'CustomerController@store')->name('store_customer');

Route::get('admin/Customer/show/{id}', 'CustomerController@show')->name('show_customer');

Route::get('admin/Customer/edit/{id}', 'CustomerController@edit')->name('edit_customer');

Route::post('admin/Customer/update', 'CustomerController@update')->name('update_customer');

Route::get('admin/Customer/destroy/{id}', 'CustomerController@destroy')->name('destroy_customer');

Route::get('admin/Customer/delete/{id}', 'CustomerController@delete')->name('delete_customer');

Route::get('admin/Customer/desactivate/{id}', 'CustomerController@desactivate')->name('desactivate_customer');

Route::get('admin/Customer/activate/{id}', 'CustomerController@activate')->name('activate_customer');

/*~~~~~~~~~~~___________Events Route__________~~~~~~~~~~~~*/

Route::get('admin/Event/index', 'EventController@index')->name('index_event');

Route::get('admin/Event/create', 'EventController@create')->name('create_event');

Route::post('admin/Event/store', 'EventController@store')->name('store_event');

Route::get('admin/Event/show/{id}', 'EventController@show')->name('show_event');

Route::get('admin/Event/edit/{id}', 'EventController@edit')->name('edit_event');

Route::post('admin/Event/update', 'EventController@update')->name('update_event');

Route::get('admin/Event/destroy/{id}', 'EventController@destroy')->name('destroy_event');

Route::get('admin/Event/show/comment', 'CommentController@addComment')->name('comment_event');


Route::get('admin/Event/show_eventVariants/{id}', 'EventController@show_eventVariants')->name('show_eventVariants');

/*~~~~~~~~~~~___________EventsProducts Route__________~~~~~~~~~~~~*/

Route::get('admin/EventsProducts/index', 'EventsProductsController@index')->name('index_eventsProducts');

Route::get('admin/EventsProducts/create', 'EventsProductsController@create')->name('create_eventsProducts');

Route::get('admin/EventsProducts/createAdmin', 'EventsProductsController@createAdmin')->name('createAdmin_eventsProducts');

Route::post('admin/EventsProducts/store', 'EventsProductsController@store')->name('store_eventsProducts');

Route::post('admin/EventsProducts/storeAdmin', 'EventsProductsController@storeAdmin')->name('storeAdmin_eventsProducts');

Route::get('admin/EventsProducts/show/{id}', 'EventsProductsController@show')->name('show_eventsProducts');

Route::get('admin/EventsProducts/edit/{id}', 'EventsProductsController@edit')->name('edit_eventsProducts');

Route::post('admin/EventsProducts/update', 'EventsProductsController@update')->name('update_eventsProducts');

Route::get('admin/EventsProducts/destroy/{id}', 'EventsProductsController@destroy')->name('destroy_eventsProducts');

/*~~~~~~~~~~~___________EventsCustoms Route__________~~~~~~~~~~~~*/

Route::get('admin/EventsCustoms/index', 'EventsCustomsController@index')->name('index_eventsCustoms');

Route::get('admin/EventsCustoms/create', 'EventsCustomsController@create')->name('create_eventsCustoms');

Route::post('admin/EventsCustoms/store', 'EventsCustomsController@store')->name('store_eventsCustoms');

Route::get('admin/EventsCustoms/show/{id}', 'EventsCustomsController@show')->name('show_eventsCustoms');

Route::get('admin/EventsCustoms/edit/{id}', 'EventsCustomsController@edit')->name('edit_eventsCustoms');

Route::post('admin/EventsCustoms/update', 'EventsCustomsController@update')->name('update_eventsCustoms');

Route::get('admin/EventsCustoms/destroy/{id}', 'EventsCustomsController@destroy')->name('destroy_eventsCustoms');

/*~~~~~~~~~~~___________Printzones Route__________~~~~~~~~~~~~*/
Route::get('admin/Printzones/index', 'PrintzonesController@index')->name('index_printzones');

Route::get('admin/Printzones/create', 'PrintzonesController@create')->name('create_printzones');

Route::post('admin/Printzones/store', 'PrintzonesController@store')->name('store_printzones');

Route::get('admin/Printzones/show/{id}', 'PrintzonesController@show')->name('show_printzones');

Route::get('admin/Printzones/edit/{id}', 'PrintzonesController@edit')->name('edit_printzones');

Route::post('admin/Printzones/update', 'PrintzonesController@update')->name('update_printzones');

Route::get('admin/Printzones/destroy/{id}', 'PrintzonesController@destroy')->name('destroy_printzones');

/*~~~~~~~~~~~___________Comments Route__________~~~~~~~~~~~~*/
Route::post('comment/add', 'CommentController@addComment');

Route::delete('comment/delete/{id}', 'CommentController@destroy')->name('destroy_comment');

/*~~~~~~~~~~~___________Front Route__________~~~~~~~~~~~~*/
Route::get('front/{id}', 'FrontController@show')->name('show_front');

/*~~~~~~~~~~~___________ProductsVariants Route__________~~~~~~~~~~~~*/
Route::get('admin/ProductsVariants/index', 'ProductsVariantsController@index')->name('index_productsVariants');

Route::get('admin/ProductsVariants/create/{id}', 'ProductsVariantsController@create')->name('create_productsVariants');

Route::post('admin/ProductsVariants/store', 'ProductsVariantsController@store')->name('store_productsVariants');

Route::get('admin/ProductsVariants/show/{id}', 'ProductsVariantsController@show')->name('show_productsVariants');

Route::get('admin/ProductsVariants/edit/{id}', 'ProductsVariantsController@edit')->name('edit_productsVariants');

Route::post('admin/ProductsVariants/update', 'ProductsVariantsController@update')->name('update_productsVariants');

Route::get('admin/ProductsVariants/destroy/{id}', 'ProductsVariantsController@destroy')->name('destroy_productsVariants');

/*~~~~~~~~~~~___________Events Products Route__________~~~~~~~~~~~~*/
Route::get('admin/EventProducts/index', 'EventProductsController@index')->name('index_eventProducts');

Route::get('admin/EventProducts/create/{id}', 'EventProductsController@create')->name('create_eventProducts');

Route::post('admin/EventProducts/store', 'EventProductsController@store')->name('store_eventProducts');

Route::get('admin/EventProducts/edit/{id}', 'EventProductsController@edit')->name('edit_eventProducts');

Route::post('admin/EventProducts/update', 'EventProductsController@update')->name('update_eventProducts');

Route::get('admin/EventProducts/destroy/{id}', 'EventProductsController@destroy')->name('destroy_eventProducts');

/*~~~~~~~~~~~___________Events Customs Route__________~~~~~~~~~~~~*/
Route::get('admin/EventCustoms/index', 'EventCustomsController@index')->name('index_eventCustoms');

Route::get('admin/EventCustoms/create/{id}', 'EventCustomsController@create')->name('create_eventCustoms');

Route::post('admin/EventCustoms/store', 'EventCustomsController@store')->name('store_eventCustoms');

Route::get('admin/EventCustoms/edit/{id}', 'EventCustomsController@edit')->name('edit_eventCustoms');

Route::post('admin/EventCustoms/update', 'EventCustomsController@update')->name('update_eventCustoms');

Route::get('admin/EventCustoms/destroy/{id}', 'EventCustomsController@destroy')->name('destroy_eventCustoms');

/*~~~~~~~~~~~__________Templates Route__________~~~~~~~~~~~~*/
Route::get('admin/Templates/index', 'TemplatesController@index')->name('index_templates');

Route::get('admin/Templates/create/{id}', 'TemplatesController@create')->name('create_templates');

Route::post('admin/Templates/store', 'TemplatesController@store')->name('store_templates');

Route::get('admin/Templates/edit/{id}', 'TemplatesController@edit')->name('edit_templates');

Route::post('admin/Templates/update', 'TemplatesController@update')->name('update_templates');

Route::get('admin/Templates/destroy/{id}', 'TemplatesController@destroy')->name('destroy_templates');

/*~~~~~~~~~~~__________Templates Components Route__________~~~~~~~~~~~~*/
Route::get('admin/TemplatesComponents/index', 'TemplatesComponentsController@index')->name('index_templatesComponents');

Route::get('admin/TemplatesComponents/create/{id}', 'TemplatesComponentsController@create')->name('create_templatesComponents');

Route::post('admin/TemplateComponents/store', 'TemplateComponentsController@store')->name('store_templateComponents');

Route::get('admin/TemplateComponents/edit/{id}', 'TemplateComponentsController@edit')->name('edit_templateComponents');

Route::post('admin/TemplateComponents/update', 'TemplateComponentsController@update')->name('update_templateComponents');

Route::get('admin/TemplateComponents/destroy/{id}', 'TemplateComponentsController@destroy')->name('destroy_templateComponents');


// Route::get('/select_product', 'EventController@ajax/{product_id}')->name('ajax_event');

Route::get('/select_product',function(){
    $prod_id = Input::get('product_id');

    $productVariants = ProductVariants::where('product_id', '=', $prod_id)->get();

    return Response::json($productVariants);
});

Route::get('/colors',function(){
    $color_id[] = Input::get('variants[]');
    $couleurs = Couleur::where('id', '=', $color_id)->get();
    // $productVariants = ProductVariants::all()->get();
    // return Response::json($couleurs, $productVariants);
    return Response::json($couleurs);
});


// $couleurs = Couleurs::select('nom')
//     ->join('productVariants', 'couleur_id', '=', 'couleurs.id')
//     ->where('couleur_id', '=', $prod_id)
//     ->get();



// Route::get('/admin/Couleur/variant_colors',function(){
//     $couleur_id[] = Input::get('variants[]');
//     //  dd($couleur_id);
//     $color = Couleur::where('id', '=', $couleur_id)->get();

//     return Response::json($color);
// });