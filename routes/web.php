<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


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

Route::get('/', function (Request $request) {

    $last_products = DB::select('
            SELECT *
            FROM products
            WHERE estado_id = 1
            ORDER BY rating DESC
            LIMIT 4
    ');

    $products = Product::where('estado_id', '1')->orderby('product_type_id', 'DESC')->orderby('rating', 'DESC')->paginate(9);

    $category = Category::all();

    return view('home', compact('products', 'last_products', 'category'));
});

Route::get('/permisos_test', function () {
    dd(
        Role::all(),
        Permission::all()
    );
});

Auth::routes();

Route::get('/home/{id?}', 'HomeController@index')->name('home');
Route::get('customize/', 'HomeController@customizeProduct')->name('home.customize');
Route::get('customizeProduct/{id}/customize', 'HomeController@customize')->name('home.customizeE');
//Route::post('customizeProduct/{id}', 'HomeController@customizeProduct')->name('home.customizeProduct');
Route::get('standarProduct/{id}/standar', 'HomeController@standar')->name('home.standar');
Route::get('invoice/{user}', 'HomeController@invoice')->name('invoice');
Route::get('invoice_detail/{invoices}/{type}/{n}/edit', 'HomeController@invoice_detail')->name('invoice_detail');

Route::get('products/calculated_value/{id}', 'ProductController@calculated_value')->name('calculated_value');
Route::get('/edit_js/{id}', 'ProductController@edit_js')->name('edit_js');
Route::get('/slice/{id}', 'ProductController@slice')->name('slice');
Route::post('/product_custom', 'Product_customController@store')->name('product_custom');

Route::get('/date', 'DateController@index')->name('date');
Route::get('/validate_date/{fecha}/{hour}', 'DateController@validate_date')->name('validate_date');
Route::get('/check_data', 'DateController@check_data')->name('check_data');
Route::get('/get_product/{id}', 'DateController@get_product')->name('get_product');

Route::prefix('admin')->group( function () {
    Route::group(['middleware' => ['role:Admin']], function (){

        Route::get('/', function () {
            return view('Admin.admin');
        })->name('admin');


        Route::get('/user', 'UserController@index')->name('user.index');
        Route::get('user/create', 'UserController@create')->name('user.create');
        Route::post('/user', 'UserController@store')->name('user.store');
        Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('user/{user}', 'UserController@update')->name('user.update');
        Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
        Route::get('/role_user/{id}', 'UserController@role_user')->name('role_user');

        Route::get('/permisos', 'PermissionController@index')->name('permission.index');
        Route::get('/permisos/create', 'PermissionController@create')->name('permission.create');
        Route::post('/permisos', 'PermissionController@store')->name('permission.store');
        Route::get('permisos/{permisos}/edit', 'PermissionController@edit')->name('permission.edit');
        Route::post('permisos/{permisos}', 'PermissionController@update')->name('permission.update');

        Route::get('/role', 'RoleController@index')->name('role.index');
        Route::get('/role/create', 'RoleController@create')->name('role.create');
        Route::post('/role', 'RoleController@store')->name('role.store');
        Route::get('role/{role}/edit', 'RoleController@edit')->name('role.edit');
        Route::post('role/{role}', 'RoleController@update')->name('role.update');
        Route::get('/roles_permission/{id}', 'RoleController@roles_permission')->name('roles_permission');


        Route::get('/products', 'ProductController@index')->name('products.index');
        Route::get('products/create', 'ProductController@create')->name('products.create');
        Route::post('/products', 'ProductController@store')->name('products.store');
        Route::get('products/{products}/edit', 'ProductController@edit')->name('products.edit');
        Route::post('products/{products}', 'ProductController@update')->name('products.update');
        Route::delete('products/{products}', 'ProductController@destroy')->name('products.destroy');
        Route::get('products/calculated_value/{id}/{id_product}/{id_topper}', 'ProductController@calculated_value')->name('calculated_value');

        Route::get('/category', 'CategoryController@index')->name('category.index');
        Route::get('category/create', 'CategoryController@create')->name('category.create');
        Route::post('/category', 'CategoryController@store')->name('category.store');
        Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
        Route::put('category/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('category/estado/{id}', 'CategoryController@estado')->name('category.estado');

        Route::get('/coverage', 'CoverageController@index')->name('cake_coverage.index');
        Route::get('coverage/create', 'CoverageController@create')->name('cake_coverage.create');
        Route::post('/coverage', 'CoverageController@store')->name('cake_coverage.store');
        Route::get('coverage/{coverage}/edit', 'CoverageController@edit')->name('cake_coverage.edit');
        Route::put('coverage/{coverage}', 'CoverageController@update')->name('cake_coverage.update');
        Route::delete('coverage/{coverage}', 'CoverageController@destroy')->name('cake_coverage.destroy');
        Route::get('coverage/estado/{id}', 'CoverageController@estado')->name('coverage.estado');

        Route::get('/doughs', 'DougController@index')->name('doughs.index');
        Route::get('doughs/create', 'DougController@create')->name('doughs.create');
        Route::post('/doughs', 'DougController@store')->name('doughs.store');
        Route::get('doughs/{doughs}/edit', 'DougController@edit')->name('doughs.edit');
        Route::put('doughs/{doughs}', 'DougController@update')->name('doughs.update');
        Route::delete('doughs/{doughs}', 'DougController@destroy')->name('doughs.destroy');
        Route::get('dough/estado/{id}', 'DougController@estado')->name('dough.estado');

        Route::get('/fillers', 'FillerController@index')->name('fillers.index');
        Route::get('fillers/create', 'FillerController@create')->name('fillers.create');
        Route::post('/fillers', 'FillerController@store')->name('fillers.store');
        Route::get('fillers/{fillers}/edit', 'FillerController@edit')->name('fillers.edit');
        Route::put('fillers/{fillers}', 'FillerController@update')->name('fillers.update');
        Route::delete('fillers/{fillers}', 'FillerController@destroy')->name('fillers.destroy');
        Route::get('filler/estado/{id}', 'FillerController@estado')->name('fillers.estado');

        Route::get('/invoices', 'InvoiceController@index')->name('invoices.index');
        Route::get('invoices/create', 'InvoiceController@create')->name('invoices.create');
        Route::post('/invoices', 'InvoiceController@store')->name('invoices.store');
        Route::get('invoices/{invoices}/{type}/{n}/edit', 'InvoiceController@edit')->name('invoices.edit');
        Route::put('invoices/{invoices}', 'InvoiceController@update')->name('invoices.update');
        Route::delete('invoices/{invoices}', 'InvoiceController@destroy')->name('invoices.destroy');
        Route::get('/invoices/calendar', 'DateController@calendar')->name('invoices.calendar');
        Route::get('/event', 'DateController@event')->name('event');
        Route::get('invoices/estado_update/{id}', 'InvoiceController@estado_update')->name('invoices.estado_update');

        Route::get('/extras', 'ExtraController@index')->name('extras.index');
        Route::get('extras/create', 'ExtraController@create')->name('extras.create');
        Route::post('/extras', 'ExtraController@store')->name('extras.store');
        Route::get('extras/{extras}/edit', 'ExtraController@edit')->name('extras.edit');
        Route::put('extras/{extras}', 'ExtraController@update')->name('extras.update');
        Route::delete('extras/{extras}', 'ExtraController@destroy')->name('extras.destroy');
        Route::get('extras/validate_weigth/', 'ExtraController@validate_weigth')->name('extras.validate_weigth');
        Route::get('extras/weigth_extras/{id}', 'ExtraController@weigth_extras')->name('extras.weigth_extras');

        /*Route::get('/weigths', 'WeigthController@index')->name('weigths.index');
        Route::get('weigths/create', 'WeigthController@create')->name('weigths.create');
        Route::post('/weigths', 'WeigthController@store')->name('weigths.store');
        Route::get('weigths/{weigths}/edit', 'WeigthController@edit')->name('weigths.edit');
        Route::put('weigths/{weigths}', 'WeigthController@update')->name('weigths.update');
        Route::delete('weigths/{weigths}', 'WeigthController@destroy')->name('weigths.destroy');
        Route::get('weigths/estado/{id}', 'WeigthController@estado')->name('weigths.estado');*/

        Route::get('/toppers', 'TopperController@index')->name('toppers.index');
        Route::get('toppers/create', 'TopperController@create')->name('toppers.create');
        Route::post('/toppers', 'TopperController@store')->name('toppers.store');
        Route::get('toppers/{toppers}/edit', 'TopperController@edit')->name('toppers.edit');
        Route::put('toppers/{toppers}', 'TopperController@update')->name('toppers.update');
        Route::delete('toppers/{toppers}', 'TopperController@destroy')->name('toppers.destroy');
        Route::get('toppers/estado/{id}', 'TopperController@estado')->name('toppers.estado');

    });
});

