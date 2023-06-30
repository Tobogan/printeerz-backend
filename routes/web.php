<?php
use App\ProductVariants;
use App\Templates;
use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Middleware\Authenticate;
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
// Route::group(['middleware' => 'cors'], function () {

Route::view('/front/{path?}', 'app');
// Route::view('/v1/events', 'app');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home')->middleware('auth');

Route::get('/', function () {
    return view('home');
})->middleware('auth');

// User Routes
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

// User SendFile
Route::get('/sendfile/{event}/{product}/{orderId}', 'SendFileController@send');
Route::post('/sendfile/{event}/{product}/{orderId}', 'SendFileController@handleSend')->name('handleSend');

// Products Routes
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

// Customers Routes
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

// Events Routes
Route::get('admin/Event/index', 'EventController@index')->name('index_event');
Route::get('admin/Event/create', 'EventController@create')->name('create_event');
Route::get('admin/Event/clientCreate/{id}', 'EventController@clientCreate')->name('clientCreate_event');
Route::post('admin/Event/store', 'EventController@store')->name('store_event');
Route::get('admin/Event/show/{id}', 'EventController@show')->name('show_event');
Route::get('admin/Event/edit/{id}', 'EventController@edit')->name('edit_event');
Route::post('admin/Event/update', 'EventController@update')->name('update_event');
Route::get('admin/Event/destroy/{id}', 'EventController@destroy')->name('destroy_event');
Route::get('admin/Event/activate/{id}', 'EventController@activate')->name('activate_event');
Route::get('admin/Event/desactivate/{id}', 'EventController@desactivate')->name('desactivate_event');
Route::get('admin/Event/show/comment', 'CommentController@addComment')->name('comment_event');
Route::get('admin/Event/show_eventVariants/{id}', 'EventController@show_eventVariants')->name('show_eventVariants');
Route::post('admin/Event/changeStatus/{event_id}/{new_status}', 'EventController@changeStatus')->name('changeStatus_event');

// EventsProducts Routes
Route::get('admin/EventsProducts/index', 'EventsProductsController@index')->name('index_eventsProducts');
Route::get('admin/EventsProducts/create', 'EventsProductsController@create')->name('create_eventsProducts');
Route::get('admin/EventsProducts/createAdmin', 'EventsProductsController@createAdmin')->name('createAdmin_eventsProducts');
Route::post('admin/EventsProducts/store', 'EventsProductsController@store')->name('store_eventsProducts');
Route::post('admin/EventsProducts/addVarianteEP', 'EventsProductsController@addVarianteEP')->name('addVarianteEP_eventsProducts');
Route::post('admin/EventsProducts/storeAdmin', 'EventsProductsController@storeAdmin')->name('storeAdmin_eventsProducts');
Route::get('admin/EventsProducts/show/{id}', 'EventsProductsController@show')->name('show_eventsProducts');
Route::get('admin/EventsProducts/edit/{id}', 'EventsProductsController@edit')->name('edit_eventsProducts');
Route::post('admin/EventsProducts/update', 'EventsProductsController@update')->name('update_eventsProducts');
Route::get('admin/EventsProducts/destroy/{id}', 'EventsProductsController@destroy')->name('destroy_eventsProducts');
Route::get('admin/EventsProducts/deleteVariant/{id}/{products_variant_id}', 'EventsProductsController@deleteVariant')->name('deleteVariant_eventsProducts');

// EventsCustoms Routes
Route::get('admin/EventsCustoms/index', 'EventsCustomsController@index')->name('index_eventsCustoms');
Route::get('admin/EventsCustoms/create/{id}', 'EventsCustomsController@create')->name('create_eventsCustoms');
Route::post('admin/EventsCustoms/store', 'EventsCustomsController@store')->name('store_eventsCustoms');
Route::get('admin/EventsCustoms/show/{id}', 'EventsCustomsController@show')->name('show_eventsCustoms');
Route::get('admin/EventsCustoms/edit/{id}', 'EventsCustomsController@edit')->name('edit_eventsCustoms');
Route::post('admin/EventsCustoms/update', 'EventsCustomsController@update')->name('update_eventsCustoms');
Route::post('admin/EventsCustoms/showUpdate', 'EventsCustomsController@show_update')->name('show_update_eventsCustoms');
Route::get('admin/EventsCustoms/destroy/{id}', 'EventsCustomsController@destroy')->name('destroy_eventsCustoms');
Route::get('admin/EventsCustoms/desactivate/{id}', 'EventsCustomsController@desactivate')->name('desactivate_eventsCustoms');
Route::get('admin/EventsCustoms/activate/{id}', 'EventsCustomsController@activate')->name('activate_eventsCustoms');
Route::post('admin/EventsCustoms/uploadFile', 'EventsCustomsController@uploadFile')->name('uploadFile_eventsCustoms');
Route::post('admin/EventsCustoms/AddSmodeColors', 'EventsCustomsController@AddSmodeColors')->name('AddSmodeColors_eventsCustoms');

Route::delete('admin/EventsCustoms/deleteFile/fonts/{font_name}', 'EventsCustomsController@deleteFile')->name('deleteFile_eventsCustoms');
Route::post('admin/EventsCustoms/updateImage', 'EventsCustomsController@updateImage/{id}')->name('updateImage_eventsCustoms');

// Printzones Routes
Route::get('admin/Printzones/index', 'PrintzonesController@index')->name('index_printzones');
Route::get('admin/Printzones/create', 'PrintzonesController@create')->name('create_printzones');
Route::post('admin/Printzones/store', 'PrintzonesController@store')->name('store_printzones');
Route::get('admin/Printzones/show/{id}', 'PrintzonesController@show')->name('show_printzones');
Route::get('admin/Printzones/edit/{id}', 'PrintzonesController@edit')->name('edit_printzones');
Route::post('admin/Printzones/update', 'PrintzonesController@update')->name('update_printzones');
Route::get('admin/Printzones/destroy/{id}', 'PrintzonesController@destroy')->name('destroy_printzones');
Route::get('admin/Printzones/desactivate/{id}', 'PrintzonesController@desactivate')->name('desactivate_printzones');
Route::get('admin/Printzones/activate/{id}', 'PrintzonesController@activate')->name('activate_printzones');

// Comments Routes
Route::post('comment/add', 'CommentController@addComment');
Route::delete('comment/delete/{id}', 'CommentController@destroy')->name('destroy_comment');

// Front Routes
Route::get('front/{id}', 'FrontController@show')->name('show_front');

// ProductsVariants Routes
Route::get('admin/ProductsVariants/index', 'ProductsVariantsController@index')->name('index_productsVariants');
Route::get('admin/ProductsVariants/create', 'ProductsVariantsController@create')->name('create_productsVariants');
Route::post('admin/ProductsVariants/store', 'ProductsVariantsController@store')->name('store_productsVariants');
Route::get('admin/ProductsVariants/show/{id}', 'ProductsVariantsController@show')->name('show_productsVariants');
Route::get('admin/ProductsVariants/edit/{id}', 'ProductsVariantsController@edit')->name('edit_productsVariants');
Route::post('admin/ProductsVariants/update', 'ProductsVariantsController@update')->name('update_productsVariants');
Route::get('admin/ProductsVariants/destroy/{id}', 'ProductsVariantsController@destroy')->name('destroy_productsVariants');
Route::get('admin/ProductsVariants/activate/{id}', 'ProductsVariantsController@activate')->name('activate_productsVariants');
Route::get('admin/ProductsVariants/desactivate/{id}', 'ProductsVariantsController@desactivate')->name('desactivate_productsVariants');

// Templates Routes
Route::get('admin/Templates/index', 'TemplatesController@index')->name('index_templates');
Route::get('admin/Templates/create', 'TemplatesController@create')->name('create_templates');
Route::post('admin/Templates/store', 'TemplatesController@store')->name('store_templates');
Route::get('admin/Templates/edit/{id}', 'TemplatesController@edit')->name('edit_templates');
Route::post('admin/Templates/update', 'TemplatesController@update')->name('update_templates');
Route::get('admin/Templates/destroy/{id}', 'TemplatesController@destroy')->name('destroy_templates');
Route::get('admin/Templates/activate/{id}', 'TemplatesController@activate')->name('activate_templates');
Route::get('admin/Templates/desactivate/{id}', 'TemplatesController@desactivate')->name('desactivate_templates');

// Templates Components Routes
Route::get('admin/TemplatesComponents/index', 'TemplateComponentsController@index')->name('index_templatesComponents');
Route::get('admin/TemplatesComponents/create', 'TemplateComponentsController@create')->name('create_templatesComponents');
Route::post('admin/TemplatesComponents/store', 'TemplateComponentsController@store')->name('store_templatesComponents');
Route::get('admin/TemplatesComponents/edit/{id}', 'TemplateComponentsController@edit')->name('edit_templatesComponents');
Route::post('admin/TemplatesComponents/update', 'TemplateComponentsController@update')->name('update_templatesComponents');
Route::get('admin/TemplatesComponents/destroy/{id}', 'TemplateComponentsController@destroy')->name('destroy_templatesComponents');
Route::get('admin/TemplatesComponents/activate/{id}', 'TemplateComponentsController@activate')->name('activate_templatesComponents');
Route::get('admin/TemplatesComponents/desactivate/{id}', 'TemplateComponentsController@desactivate')->name('desactivate_templatesComponents');

// Fonts Routes
Route::get('admin/Fonts/index', 'FontsController@index')->name('index_fonts');
Route::get('admin/Fonts/create', 'FontsController@create')->name('create_fonts');
Route::post('admin/Fonts/store', 'FontsController@store')->name('store_fonts');
Route::get('admin/Fonts/edit/{id}', 'FontsController@edit')->name('edit_fonts');
Route::post('admin/Fonts/update', 'FontsController@update')->name('update_fonts');
Route::get('admin/Fonts/destroy/{id}', 'FontsController@destroy')->name('destroy_fonts');
Route::get('admin/Fonts/activate/{id}', 'FontsController@activate')->name('activate_fonts');
Route::get('admin/Fonts/desactivate/{id}', 'FontsController@desactivate')->name('desactivate_fonts');

// EventLocalDownload
Route::post('admin/EventLocalDownload/store', 'EventLocalDownloadController@store')->name('store_eventLocalDownload');
Route::get('admin/EventLocalDownload/destroy/{id}', 'EventLocalDownloadController@destroy')->name('destroy_eventLocalDownload');

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

Route::get('/templates',function(){
    $templates = Templates::all();
    return Response::json($templates);
});
// }