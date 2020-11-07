<?php



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


// Route::group(['middleware' => ['role:business']], function () {
// });



Route::get('/', function () {  

    return redirect('/login');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/upload-files', 'HomeController@upload');

//User
Route::get('/user/getdata','admin\UserController@getData');
Route::post('/dashboard/edit/user/{id}','admin\UserController@update');

//Post Controller


//Feilds 




Route::group( [ 'middleware' => 'auth' ], function () {
    //front

    Route::post('feilds/addOptions','FeildsController@storeOptions');
    Route::put('feilds/editOptions/{id}','FeildsController@editOptions');
    Route::get('feilds/options/{id}','FeildsController@getOptions');
    Route::get('feilds/categories/{id}','FeildsController@getCategories');
    
    Route::delete('feilds/removeOptions/{id}','FeildsController@deleteOptions');
    Route::delete('feilds/removeCategories/{id}','FeildsController@deleteCategories');
    
    Route::post('/admin/feilds/addCategory','FeildsController@addCategory');
    
    Route::resource('feilds',"FeildsController");
    //End Feilds

    
    //Category
//Backend
Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'namespace' => 'admin',
		'middleware' => 'role:admin'
], function () {
    //Category
    Route::get('/home', function () {  

        return redirect('/dashboard/settings');
    });
    Route::get('/category/options','CategoryController@getOptions');

    Route::get('/user/getRoles','UserController@getRoles');

Route::resources([
    'settings' => 'SettingsController',
    'category'=>'CategoryController',
    'area'=>'AreaController',
    'user'=>'UserController',
    'package'=>'PackageController'
    
]);
});
});
//For all
Route::get('/area/list','AreaController@getList');
Route::get('dashboard/category/options','admin\CategoryController@getOptions');


Route::get('/{any}', 'HomeController@any')->where('any', '.*');